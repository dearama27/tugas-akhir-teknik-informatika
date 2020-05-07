<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    protected $view  = 'order';

    function __construct()
    {
        parent::__construct();
        $this->base             = route($this->view.'.index');
        $this->data['resource'] = $this->view;
        $this->view             = $this->template.$this->view;
    }

    public function index(Order $model, Request $req) {

        if($req->get('search') != '') {

            $serach = strtolower($req->get('search'));

            $model = $model->where(DB::raw('LOWER(date_delivery)'), "LIKE", "%$serach%");
        }


        //Filter Hanya yang belum terelasi dengan spkb/belum dibuat spkb
        $model = $model->where('related_spkb', 0);
        
        $this->data['results'] = $model->paginate(10);

        return view($this->view.'.index', $this->data);
    }

    public function create() {

        $this->data['products'] = Product::get();
        return view($this->view.'.form', $this->data);
    }

    public function show() {

    }

    public function edit(Order $model, $id) {
        $this->data['products'] = Product::get();
        $this->data['data'] = $model->where('id', $id)->first();
        return view($this->view.'.form', $this->data);
    }



    //Save Order
    public function store(Order $model, Request $req) {

        try {   
            DB::beginTransaction();
            if(isset($req->id)) {
                $model = Order::find($req->id);
            }

			$model->date_delivery      = $req->date_delivery;
			$model->ttl_price          = $this->getInt($req->ttl_price);
			$model->ttl_qty            = $req->ttl_qty;
			$model->customer_id        = $req->customer_id;

            $model->save();

            foreach($req->detail as $detail) {
                OrderProduct::updateOrCreate(
                    ['id' => $detail['id'] ?? 0],
                    [
                        "order_id" => $model->id,
                        "product_id" => $detail['product_id'],
                        "price" => $this->getInt($detail['price']),
                        "qty"   => $detail['qty'],
                        "total" => $this->getInt( $detail['total']),
                    ]
                );
            }

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


    public function update() {

    }

    public function destroy(Order $model, $id) {

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
