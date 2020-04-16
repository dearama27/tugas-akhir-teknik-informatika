<?php

namespace App\TrusCRUD\Core\Controllers;

use App\Http\Controllers\Controller;

use App\TrusCRUD\Core\Models\AccessRoleToMenu;
use App\TrusCRUD\Core\Models\AccessMenu;
use App\TrusCRUD\Core\Models\AccessRole;
use App\TrusCRUD\Core\Models\AccessAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AccessRoleController extends Controller
{

    protected $base  = '/access/role';
    protected $view  = 'adminLTE.permissions.role';

    function __construct()
    {
        parent::__construct();
        $this->data['base'] = $this->base;
    }

    public function index(AccessRole $model, Request $req) {

        if($req->get('search') != '') {

            $serach = $req->get('search');

            $model = $model->where('name', "LIKE", "%$serach%");
        }

        $roles               = $model->paginate();
        $this->data['roles'] = $roles;

        return view($this->view.'.main', $this->data);
    }

    public function all(AccessRole $model) {

        $roles = $model->withTrashed()->get();
        $this->data['roles'] = $roles;
        return view($this->view.'.main', $this->data);
    }

    public function form(AccessRole $model, $UUID=false) {
        if($UUID) {
            $this->data['data']  = $model->where('uuid', $UUID)->first();
        }
        return view($this->view.'.form', $this->data);
    }

    public function save(Request $req, AccessRole $model) {
        try {

            if(isset($req->id)) {
                $model = AccessRole::find($req->id);
            } else {
                $model->uuid        = Str::uuid();
            }

            $model->name        = $req->name;
            $model->description = $req->description;

            $model->save();

            $status     = "success";
            $message    = "Berhasil disimpan.";

        } catch (\Exception $err) {
            $status     = "error";
            $message    = $err->getMessage();
        }

        return redirect($this->base)->with('status', $status)->with('message', $message);
    }

    public function set_persmission(Request $req) {

        try {
            DB::beginTransaction();
            $form['access_action_suffix']           = $req->get('action');
            $form['access_menu_id']                 = $req->get('menu_id');
            $form['access_role_id']                 = $req->get('role_id');

            if($req->get('status') == "create") {
                AccessRoleToMenu::create($form);
                $ms = "Role Successful Created!";
            } else {
                $ms = "Role Successful Deleted!";
                AccessRoleToMenu::where($form)->delete();
            }

            Cache::forget('menu-'.$req->get('role_id'));
            DB::commit();

        } catch (\Exception $th) {
            DB::rollBack();
            $ms = $th->getMessage();
        }

        return response()->json([
            'status'    => true,
            'message'   => $ms
        ]);

    }

    public function detail(AccessRole $model, Request $req, $UUID) {

        $this->data['role']     = $model->where('uuid', $UUID)->first();
        $this->data['menus']    = AccessMenu::get();
        $action                 = AccessAction::get()->toArray();
        $this->data['actions']  = $action;

        // $this->data['actions']  = [
        //     ["prefix" => "show", "name" => "Show"],
        //     ["prefix" => "insert", "name" => "Insert"],
        //     ["prefix" => "update", "name" => "Update"],
        //     ["prefix" => "detail", "name" => "Detail"],
        //     ["prefix" => "delete", "name" => "Delete"],
        //     ["prefix" => "print", "name" => "Print"],
        //     ["prefix" => "confirm", "name" => "Confirm"]
        // ];

        return view($this->view.'.detail', $this->data);
    }

    public function delete(Request $req, AccessRole $model, $UUID) {

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
}
