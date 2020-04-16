<?php

namespace App\TrusCRUD\Core\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    protected $base  = '/setting';
    protected $view  = 'setting';

    function __construct()
    {
        parent::__construct();
        $this->base                = route($this->view.'.account');
        $this->data['resource']    = $this->view;
        $this->data['base']        = $this->base;
        $this->view                = $this->template.$this->view;
    }

    public function account(Request $req) {

        return view($this->view.'.account.main', $this->data);

    }

    public function security(Request $req) {
        return view($this->view.'.security.main', $this->data);

    }

    public function logging(Request $req) {

        $load = storage_path("logs/users-all.log");
        $log  = file_get_contents($load);

        $this->data['log'] = explode("\n", $log);

        return view($this->view.'.logging.main', $this->data);

    }

    public function appearance(Request $req) {

        $this->data['themes'] = ['adminLTE'];

        return view($this->view.'.appearance.main', $this->data);
    }
}
