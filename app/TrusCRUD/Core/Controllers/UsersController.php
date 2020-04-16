<?php

namespace App\TrusCRUD\Core\Controllers;

use App\Http\Controllers\Controller;

use App\TrusCRUD\Core\Models\AccessRole;
use App\TrusCRUD\Core\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UsersController extends Controller
{

    protected $base  = '/users';
    protected $view  = 'adminLTE.user';

    function __construct()
    {
        $this->data['base'] = $this->base;
        $this->data['pageName'] = 'Manage User';
    }

    public function index(UsersModel $model, Request $req) {

        if($req->get('search') != '') {

            $serach = $req->get('search');

            $model = $model->where('name', "LIKE", "%$serach%");
        }

        $users               = $model->paginate(10);
        $this->data['users'] = $users;

        return view($this->view.'.main', $this->data);
    }

    public function all(UsersModel $model, Request $req) {

        if($req->get('search') != '') {

            $serach = $req->get('search');

            $model = $model->where('name', "LIKE", "%$serach%");
        }

        $users = $model->withTrashed()->paginate(10);
        $this->data['users'] = $users;

        return view($this->view.'.main', $this->data);
    }

    public function create(AccessRole $role) {
        $this->data['roles'] = $role->all();

        return view($this->view.'.form',  $this->data);
    }
    
    public function edit(AccessRole $role, $UUID='') {
        $this->data['roles'] = $role->all();

        if($UUID != '') {
            $this->data['data'] = UsersModel::where('uuid', '=', $UUID)->first();
        }

        return view($this->view.'.form',  $this->data);
    }

    public function store(Request $req, UsersModel $model) {

        try {
            $user = Auth::user();
            $post = $req->all();

            if(isset($req->id)) {
                $model = UsersModel::find($req->id);

                // Log::channel('all')->info('Update User Successful', [
                //     "id"   => $user->id,
                //     "name" => $user->name,
                //     "data" => $post
                // ]);

            } else {
                $model->uuid  = Str::uuid();
                // Log::channel('all')->info('Create User Successful', [
                //     "id"   => $user->id,
                //     "name" => $user->name,
                //     "data" => $post
                // ]);
            }

            $model->name                = $req->name;
            // $model->fullname            = $req->fullname;
            $model->phone               = $req->phone;
            $model->email               = $req->email;

            if(isset($req->access_role_id)) {
               $model->access_role_id = $req->role;
            } else {
                $model->access_role_id = auth()->user()->access_role_id;
            }

            if(isset($req->id)) {
                if(isset($req->password)) {
                    $model->password            = Hash::make($req->password);
                }
            } else {
                $model->password            = Hash::make($req->password);
            }

            $model->save();

            $status     = "success";
            $message    = "Berhasil disimpan.";

        } catch (\Exception $err) {
            $status     = "error";
            $message    = $err->getMessage();
        }

        if($req->json == 'true') {
            return response()->json([
                'status' => $status,
                'message' => $message
            ]);
        } else {
            return redirect($this->base)->with('status', $status)->with('message', $message);
        }

    }

    public function detail(UsersModel $model, Request $req, $UUID) {

        $this->data['invoice'] = $model->withTrashed()->where('uuid', $UUID)->first();

        return view($this->view.'.detail', $this->data);
    }

    public function destroy(Request $req, UsersModel $model, $UUID) {

        try {
            $model->where('uuid', $UUID)->delete();
            $status  = true;
            $message = 'Berhasil dihapus.';
        } catch (\Exception $err) {
            $status  = true;
            $message = $err->getMessage();
        }

        $output['status']   = $status;
        $output['message']  = $message;

        return response()->json($output);
    }

    public function upload_avatar(Request $req) {
        try {

            $upload = $this->upload($req->file('file'));

            $user = Auth::user();

            $user->avatar = $upload['uuid'];
            $user->save();
            
            $status = true;
            $message = 'Successful.';
        } catch (\Throwable $th) {
            $status = false;
            $message = $th->getMessage();
        }

        return response()->json([
            "status" => $status,
            "message" => $message
        ]);
        
    }
}
