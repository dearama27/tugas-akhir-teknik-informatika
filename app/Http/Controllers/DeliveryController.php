<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use App\Spkb;
use App\SpkbOrder;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{

    protected $view  = 'delivery';

    function __construct()
    {
        parent::__construct();
        $this->base             = route($this->view.'.index');
        $this->data['resource'] = $this->view;
        $this->view             = $this->template.$this->view;
    }

    public function index(Spkb $model, Request $req) {

        if($req->get('search') != '') {

            $serach = strtolower($req->get('search'));

            $model = $model->where(DB::raw('LOWER(date_delivery)'), "LIKE", "%$serach%");
        }

        $user = auth()->user();
        $role = $user->access_role_id;

        if($role == 3) {
            $model = $model->where('driver_id', $user->id);
        }

        $model = $model->where('driver_id', '<>', 'NULL')->orderBy('date_delivery', 'desc');

        $this->data['results'] = $model->paginate(10);

        return view($this->view.'.index', $this->data);
    }

    public function create() {
        return view($this->view.'.form', $this->data);
    }

    public function show() {

    }


    public function edit(Request $req, Spkb $model, $id) {
        $data               = Spkb::where('id', $id)->first();
    
        $this->data['data'] = $data;
        $order_id           = $req->get('order_id');
        
        if($order_id != '') {
            $spkbOrder              = SpkbOrder::where('order_id', $order_id)->first();;

            $this->data['order']    = $spkbOrder;
            $this->data['products'] = $spkbOrder->order->detail;
            
            return view($this->view.'.form', $this->data);
        } else {
            $this->data['detail'] = $data->detail;
            return view($this->view.'.customer', $this->data);
        }
    }


    private function store_delivery(Request $req) {

        try {
            DB::beginTransaction();

            SpkbOrder::where('id', $req->id)->update(["delivery_status" => $req->delivery_status]);

            //Update Data Order
            Order::where('id', $req->order_id)->update([
               "ttl_actual_qty" => $req->ttl_actual_qty,
               "ttl_actual_total" => $this->getInt($req->ttl_actual_total) 
            ]);

            foreach($req->product as $prod) {
                OrderProduct::where(['id' => $prod['order_product_id']])->update([
                    "actual_qty"   => $prod['actual_qty'],
                    "actual_total" => $this->getInt($prod['actual_total'])
                ]);
            }
            
            $status = 'success';
            $message = 'Berhasil disimpan.';
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            $status = 'error';
            $message = $th->getMessage().' '.$th->getLine();
        }

        return redirect($this->base)->with('status', $status)->with('message', $message);
    }

    public function store(Spkb $model, Request $req) {

        if($req->get('input-delivery')) {
            return $this->store_delivery($req);
        } else {
    
            try {   
                DB::beginTransaction();
                if(isset($req->id)) {
                    $model = Spkb::find($req->id);
                }
    
                $model->date_delivery  = $req->date_delivery;
                $model->driver_id      = $req->driver_id;
                $model->ttl_order      = $req->ttl_order;
                $model->ttl_price      = $req->ttl_price;
                $model->ttl_qty        = $req->ttl_qty;
    
                $model->save();
    
                $status  = 'success';
                $message = "Save Successfully";
                DB::commit();
            } catch (\Exception $er) {
                DB::rollBack();
                $status  = 'error';
                $message = $er->getMessage();
            }
    
            if($req->get('format') == 'json') {
                $response = [
                    'status' => $status,
                    'message' => $message,
                ];
                return response()->json($response);
            }
    
            return redirect($this->base)->with('status', $status)->with('message', $message);

        }
    }


    public function update() {

    }

    public function destroy(Spkb $model, $id) {

        try {
            $model->where('id', $id)->delete();
            $status  = true;
            $message = 'Delete Successfully.';
        } catch (\Exception $err) {
            $status  = false;
            $message = $err->getMessage();
        }

        $output['status']   = $status;
        $output['message']  = $message;

        return response()->json($output);
    }

}
