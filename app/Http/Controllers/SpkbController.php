<?php

namespace App\Http\Controllers;

use App\DistributionCenter;
use App\Order;
use Illuminate\Http\Request;
use App\Spkb;
use App\SpkbOrder;
use App\User;
use Illuminate\Support\Facades\DB;
use PDF;

class SpkbController extends Controller
{

    protected $view  = 'spkb';

    function __construct()
    {
        parent::__construct();
        $this->base             = route($this->view.'.index');
        $this->data['resource'] = $this->view;
        $this->view             = $this->template.$this->view;
    }

    //Menampilkan Daftar SPKB
    public function index(Spkb $model, Request $req) {

        //Query Pencarian
        if($req->get('search') != '') {

            $serach = strtolower($req->get('search'));

            $model = $model->where(DB::raw('LOWER(date_delivery)'), "LIKE", "%$serach%");
        }
        
        $this->data['results'] = $model->paginate(10);

        return view($this->view.'.index', $this->data);
    }

    //Menampilkan Form 
    public function create() {
        //Tidak ada Form
        // return view($this->view.'.form', $this->data);
    }

    //Menampilkan Form Edit SPKB
    public function edit(Spkb $model, $id) {
        //Mengambil data spkb berdasarkan ID
        $this->data['data']     = $model->where('id', $id)->first();

        //Mengambil data user dengan access id 3 = driver
        $this->data['driver']   = User::where('access_role_id', 3)->get();

        //Mengambil data DC
        $this->data['dc']       = DistributionCenter::get();

        return view($this->view.'.form', $this->data);
    }

    //Mencetak dalam format PDF
    public function print($code_spkb) {

        //Mengambil data spkb berdasarkan CODE
        $spkb = Spkb::where('code', $code_spkb)->first();

        $data['spkb'] = $spkb;

        $pdf = PDF::loadView('pdf.spkb', $data)->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    //Meng-generate SPKB
    public function generate(Request $request) {
        
        //Ambil Data Distribusi Center
        $distribution_zone = DistributionCenter::get();

        //Tanggal Besok
        $date_order        = gmdate('Y-m-d', (strtotime('+1 days'))+60*60*7);

        foreach($distribution_zone as $dc) {
            $date   = gmdate('Y-m-d', time()+60*60*7);

            //Order Berdasarkan Customer distribusi center
            $order = Order::whereHas('customer', function($q) use($dc) {
                $q->where('distribution_center_id', $dc->id);
            })->where(['date_delivery'=>$date,'related_spkb' => 0])->get();

            if($order->count() > 0) {

                //Membuat Kode SPKB
                $count  = Spkb::where('date_delivery', $date)->get()->count();
                $code   = $dc->dc_code.gmdate('Ymd', (strtotime('+1 days'))+60*60*7).str_pad($count, 4, '0', STR_PAD_LEFT);

                //Inisial variabel total
                $ttl_order = 0;
                $ttl_price = 0;
                $ttl_qty   = 0;

                foreach($order as $o) {

                    //Menghitung total
                    $ttl_order  += 1;
                    $ttl_price  += $o->ttl_price;
                    $ttl_qty    += $o->ttl_qty;
                }

                //Data yang akan di simpan ke table spkb dengan ORM (Object Relational Mapping)
                $header["code"]          = $code;
                $header["date_delivery"] = $date;
                $header["driver_id"]     = 0;
                $header["pic_id"]        = $dc->id;
                $header["ttl_order"]     = $ttl_order;
                $header["ttl_price"]     = $ttl_price;
                $header["ttl_qty"]       = $ttl_qty;

                //Simpan data spkb
                $spkb = Spkb::create($header);

                //Simpan data order yang ada di spkb
                foreach($order as $o) {
                    
                    //simpan ke table spkb_orders
                    SpkbOrder::create([
                        'spkb_id'  => $spkb->id,
                        'order_id' => $o->id,
                    ]);
                    
                    //Update order bahwa sudah terelasi dengan spkb.
                    $o->update(['related_spkb' => 1]);
                }

            }
        }

        return redirect()->to(route('spkb.index'));
    }


    //simpan data spkb
    public function store(Spkb $model, Request $req) {

        try {   
            DB::beginTransaction();

            if(isset($req->id)) {

                //
                $model = Spkb::find($req->id);
            }

			$model->date_delivery   = $req->date_delivery;
			$model->driver_id       = $req->driver_id;
			$model->pic_id          = $req->pic_id;
			$model->ttl_order       = $req->ttl_order;
			$model->ttl_price       = $this->getInt($req->ttl_price);
			$model->ttl_qty         = $req->ttl_qty;

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

    //Hapus SPKB
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
