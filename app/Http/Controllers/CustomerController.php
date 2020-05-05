<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\DistributionCenter;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    protected $view  = 'customer';

    function __construct()
    {
        parent::__construct();
        $this->base             = route($this->view.'.index');
        $this->data['resource'] = $this->view;
        $this->view             = $this->template.$this->view;
    }

    //Index List Customer
    public function index(Customer $model, Request $req) {

        if($req->get('search') != '') {

            $serach = strtolower($req->get('search'));

            $model = $model->where(DB::raw("CONCAT(LOWER(name))"), "LIKE", "%$serach%");
        }
        
        $this->data['results'] = $model->orderBy('updated_at', 'desc')->paginate(10);

        return view($this->view.'.index', $this->data);
    }

    //Form Add Customer
    public function create() {
        $this->data['dc'] = DistributionCenter::get();

        return view($this->view.'.form', $this->data);
    }

    public function show() {

    }

    public function edit(Customer $model, $id) {
        $this->data['data'] = $model->find($id)->first();
        $this->data['dc'] = DistributionCenter::get();
        return view($this->view.'.form', $this->data);
    }


    public function store(Customer $model, Request $req) {

        // dd($req->all);
        try {   
            DB::beginTransaction();
            if(isset($req->id)) {
                $model = Customer::find($req->id);
            } else {
                $count = $model->get()->count();
                $model->customer_code = 'MBS-C'.str_pad($count+1, 4, "0", STR_PAD_LEFT);
            }

			$model->name          = $req->name;
			$model->address       = $req->address;
			$model->mobile_phone  = $req->mobile_phone;
			$model->lat           = $req->lat;
			$model->lng           = $req->lng;
			$model->join_at       = $req->join_at;
			$model->distribution_center_id       = $req->distribution_center_id;


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

    public function destroy(Customer $model, $id) {

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
