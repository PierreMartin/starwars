<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Tag;
use App\Category;
use App\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
//use Input;

class BagController extends Controller
{
    public function bagAddBySession() {
        $product_id = Input::get('product_id');     // id du produit récupéré au click au moment d'ajouter un produit
        $quantity   = Input::get('quantity');

        Session::push("key.product_id", $product_id);
        Session::push("key.product_nb", $quantity +1);

        /////// je pense quil faudrais faire un put dans un foreach pour la gestion des supression des item ///////
        /*
        $products = Product::where('id', $product_id)->firstOrFail();
        foreach ($products as $product) {
            Session::put('bag.products.'.$product_id, [
                //"title"     => $product->title,
                "quantite"  => $quantity+1,
                //"prix"      => $product->prix
            ]);
        }
        */

        return redirect()->back()->with('message', 'Article ajouté au panier');
    }



    public function bagShow()
    {
        if ( Session::has('key') ) {

            $bag_ids  = Session::get("key.product_id"); // contient plusieurs id
            $bag_nbs  = Session::get("key.product_nb");

            $tab_product    = []; // on stock les produits
            $tab_quantity   = []; // on stock les quantités
            $total_order = 0;
            foreach($bag_ids as $key => $idProduct){
                $quantity = $bag_nbs[$key];
                //echo $idProduct." -- ".$quantity."<br>";
                $product = Product::where('id', $idProduct)->firstOrFail();
                $total_order = $total_order + $product->price * $quantity;
                array_push($tab_product, $product);
                array_push($tab_quantity, $quantity);
            }
        }

        return view('front.panier.panier', compact('tab_product', 'tab_quantity', 'total_order'));
    }


    public function bagConfirm()
    {
        if ( Session::has('key') ) {

            $bag_ids  = Session::get("key.product_id"); // contient plusieurs id
            $bag_nbs  = Session::get("key.product_nb");

            $tab_product    = []; // on stock les produits
            $tab_quantity   = []; // on stock les quantités
            $total_order = 0;
            foreach($bag_ids as $key => $idProduct){
                $quantity = $bag_nbs[$key];
                //echo $idProduct." -- ".$quantity."<br>";
                $product = Product::where('id', $idProduct)->firstOrFail();
                $total_order = $total_order + $product->price * $quantity;
                array_push($tab_product, $product);
                array_push($tab_quantity, $quantity);
            }
        }

        return view('front.panier.panier_confirm', compact('tab_product', 'tab_quantity', 'total_order'));
    }


    public function bagStore(Request $request) {
        /////////////////////// "AUTH" CLIENT ///////////////////////
        $customer_name  = Input::get('customer_name');
        $customer_email = Input::get('customer_email');

        // si username + email (provenant des inputs) match avec ceux de la bdd :
        $customer = Customer::whereRaw('username = ? and email = ?', [$customer_name, $customer_email])->first();

        if( !empty($customer) ) {
            $order = Order::create($request->all());

            /////// On va associer LA commande aux produits :
            //$order->products()->sync($request->get('products'));

            $customer_id = $customer->id;

            $order->customer_id = $customer_id;
            $order->save();

            Session::flush();

            return redirect(url('/'))->with('message', 'Votre commande à bien été pris en compte !');
        } else {
            return redirect()->back()->with('error', 'Erreur, nom d\'utilisateur ou mot de passe incorrect !');
        }

    }


    public function bagDelete()
    {
        Session::forget("key");

        return redirect()->back()->with('message', 'Le produit à bien été suprimé');
    }



}
