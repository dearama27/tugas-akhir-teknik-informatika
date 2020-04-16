<?php
namespace App\Http\Controllers;

use App\Customer;
use App\Helpers\Role;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $data = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $product = Product::limit(7)->get();
        $product_label = [];
        $product_label_full = [];

        foreach($product as $prod) {
            $words = explode(" ", $prod->name);
            $acronym = "";

            foreach ($words as $w) {
                $acronym .= $w[0];
            }

            $product_label[] = $acronym;
            $product_label_full[] = $prod->name;
        }


        $this->data['count'] = [
            "users" => User::count(),
            'customer' => Customer::count(),
            'product_label' => json_encode($product_label),
        ];

        $this->data['product_label'] = json_encode($product_label);
        $this->data['product_label_full'] = json_encode($product_label_full);

        Role::isAllow("show");

        return view('adminLTE.dashboard.main', $this->data);
    }
}
