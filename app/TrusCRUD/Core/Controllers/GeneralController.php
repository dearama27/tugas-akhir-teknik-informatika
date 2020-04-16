<?php

namespace App\TrusCRUD\Core\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Gate;

class GeneralController extends Controller
{
    protected $base  = '/profile';
    protected $view  = 'adminLTE.general';

    function __construct()
    {
        $this->data['base'] = $this->base;
    }

    function profile(Request $req) {

        return view($this->view.'.profile', $this->data);
    }
    
}
