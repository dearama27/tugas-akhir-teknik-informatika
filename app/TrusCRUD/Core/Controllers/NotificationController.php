<?php
namespace App\TrusCRUD\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class NotificationController extends Controller {
   
    protected $view  = 'adminLTE.general';
    
    function __construct()
    {
        $this->data['base'] = $this->base;
    }

    function notification(Request $req) {
        return view($this->view.'.notification', $this->data);
    }

    function notification_json(Request $req) {
        $notification = auth()->user()
            ->notifications()
            ->select('created_at','id', 'data', 'read_at');

        $notification = $notification->orderBy('id', 'desc');

        if($req->limit) {
            $notification = $notification->limit(4)->get();
        } elseif($req->paginate) {
            $notification      = $notification->paginate($req->paginate);
        } else {
            $notification = $notification->limit(4)->get();
        }

        $out['notifications'] = $notification;

        return response()->json($out);
    }

    //Read Notification
    function notification_mark_as_read(Request $req) {
        try {

            auth()->user()->unreadNotifications->where('id', $req->id)->markAsRead();
            $response = [
                'status'  =>true,
                'message' => ''
            ];
        } catch (\Throwable $th) {
            $response = [
                'status'  =>false,
                'message' => $th->getMessage()
            ];
        }

        return response()->json($response);
    }
}