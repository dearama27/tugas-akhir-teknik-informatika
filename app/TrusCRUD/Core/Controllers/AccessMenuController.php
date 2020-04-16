<?php

namespace App\TrusCRUD\Core\Controllers;

use App\Http\Controllers\Controller;

use App\TrusCRUD\Core\Models\AccessMenu;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AccessMenuController extends Controller {

    protected $base     = '/access/menu';
    protected $view     = 'adminLTE.permissions.menu';
    protected $resource = 'permissions';
    protected $router;


    function __construct(Router $router)
    {
        parent::__construct();

        $this->data['base'] = $this->base;
        $this->router = $router;

    }

    public function index(AccessMenu $model, Request $req) {

        $menus                   = $model->all()->sortByDesc('updated_at');
        $this->data['menus']     = $menus;
        $this->data['recursive'] = $model->getRecursive();

        return view($this->view.'.main', $this->data);
    }

    public function all(AccessMenu $model) {

        $roles               = $model->withTrashed()->get();
        $this->data['menus'] = $roles;

        return view($this->view.'.main', $this->data);
    }

    public function form(Router $router, AccessMenu $model, $UUID=false) {

        $routes = collect($this->router->getRoutes())->map(function ($route) {
            // if($route->getName() && !preg_match("/\./", $route->getName())) {
            if($route->getName()) {
                return $this->filterRoute([
                    'domain' => $route->domain(),
                    'method' => implode('|', $route->methods()),
                    'uri'    => $route->uri(),
                    'name'   => $route->getName(),
                    'action' => ltrim($route->getActionName(), '\\')
                ]);
            }
        })->filter()->all();

        $this->data['routes']       = $routes;
        $this->data['menus']        = $model->all();
        $this->data['actions']      = DB::table('access_actions')->select('name','supfix')->get();
        $this->data['fontawesome']  = explode("\n", file_get_contents(__DIR__.'/fontawesome'));

        if($UUID) {
            $this->data['data'] = $model->where('uuid', '=', $UUID)->first();
            // dd($this->data['data']->toArray());
        }

        return view($this->view.'.form', $this->data);
    }

    protected function filterRoute(array $route)
    {

        return $route;
    }

    public function save(Request $req, AccessMenu $model) {

        try {
            if(isset($req->id)) {
                $model = AccessMenu::find($req->id);
            }

            $model->uuid         = Str::uuid();
            $model->title        = $req->title;
            $model->route_name   = $req->route_name;
            $model->url          = $req->url;
            $model->description  = $req->description;
            $model->parent_id    = $req->parent_id;
            $model->icon         = $req->icon;
            $model->actions      = json_encode($req->actions);

            $model->save();

            $status     = "success";
            $message    = "Berhasil disimpan.";

        } catch (\Exception $err) {

            $status     = "error";
            $message    = $err->getMessage();

        }

        return redirect($this->base)->with('status', $status)->with('message', $message);
    }

    public function save_nested(Request $req) {
        try {
            DB::beginTransaction();
            foreach($req->data as $item) {
                AccessMenu::where('id', $item['id'])
                          ->update(
                              [
                                  'order'     => $item['order'],
                                  'parent_id' => $item['parent_id']
                              ]
                            );
            }
            DB::commit();
            $status  = 'success';
            $message = 'Update Successfully';

            Cache::flush();
        } catch (\Exception $err) {
            DB::rollBack();
            $status  = 'error';
            $message = $err->getMessage();
        }

        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function detail(AccessMenu $model, Request $req, $UUID) {

        $this->data['data'] = $model->withTrashed()->where('uuid', $UUID)->first();
        return view($this->view.'.detail', $this->data);
    }

    public function delete(Request $req, AccessMenu $model, $UUID) {

        try {
            $model->where('uuid', $UUID)->delete();
            $status  = true;
            $message = 'Berhasil dihapus.';
        } catch (\Exception $err) {
            $status  = false;
            $message = $err->getMessage();
        }

        $output['status']   = $status;
        $output['message']  = $message;

        return response()->json($output);
    }
}
