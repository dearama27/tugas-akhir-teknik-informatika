<?php

namespace App\Http\Controllers;

use App\TrusCRUD\Core\Models\Files;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $template = 'adminLTE.';
    public $data  = [];
    protected $base;

    function __construct() {

    }

    function getInt($string) {

        return preg_replace("/[^0-9-]+/", '', $string);
    }

    public function upload($file){

        try {
            DB::beginTransaction();
            $destination      = 'data/uploads';
            $db = new Files();
    
            $db->uuid          = Str::uuid();
            $db->format        = 'file';
            $db->size          = $file->getSize();
            $db->original_name = $file->getClientOriginalName();
            $db->extension     = $file->getClientOriginalExtension();
            $db->name          = time().'-'.$db->uuid.'.'.$db->extension;
            $db->path          = $destination.'/'.$db->name;
            $db->url           = url($destination.'/'.$db->name);

            $db->save();

            $file->move($destination, time().'-'.$db->uuid.'.'.$db->extension);
            DB::commit();
            
            return [
                "uuid" => $db->uuid,
                "format" => $db->format,
                "size" => $db->size,
                "original_name" => $db->original_name,
                "extension" => $db->extension,
                "path" => $db->path,
                "url" => $db->url,
                "name" => $db->name,
            ];

        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            throw $th;
        }
	}
}
