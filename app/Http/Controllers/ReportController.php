<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spkb;
use PDF;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\PDF;

class ReportController extends Controller
{

    protected $view  = 'report';

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
        $model = $model->where('driver_id', '<>', 'NULL')->orderBy('date_delivery', 'desc');
        
        $this->data['results'] = $model->paginate(10);

        return view($this->view.'.index', $this->data);
    }

    public function create() {
        return view($this->view.'.form', $this->data);
    }

    public function show() {

    }

    public function edit(Spkb $model, $id) {
        $this->data['data'] = $model->find($id)->first();
        return view($this->view.'.form', $this->data);
    }



    public function store(Spkb $model, Request $req) {

        try {   
            DB::beginTransaction();
            if(isset($req->id)) {
                $model = Spkb::find($req->id);
            }

			$model->date_delivery      = $req->date_delivery;
			$model->driver_id      = $req->driver_id;
			$model->ttl_order      = $req->ttl_order;
			$model->ttl_price      = $req->ttl_price;
			$model->ttl_qty      = $req->ttl_qty;


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


    //Print Report
    function print(Request $request, Spkb $model) {
        $model = $model->where('driver_id', '<>', 'NULL')->orderBy('date_delivery', 'desc');
        
        $this->data['results'] = $model->get();

        $pdf = PDF::loadView('pdf.report', $this->data)->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

}
