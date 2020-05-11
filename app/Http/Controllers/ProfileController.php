<?php

namespace App\Http\Controllers;

class ProfileController extends Controller{
function index(){
    return 'Ini halaman Contoh';
}

    public function myProfile(){
        $nama = "Dea";
        $tempat_lahir = "Jakarta";
        $jabatan = "CEO";

        return view('adminLTE.profile', compact('nama', 'tempat_lahir', 'jabatan'));
    }

}

?>
