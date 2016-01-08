<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\LoginCustomerFormRequest; // add
use App\Http\Controllers\Controller;
use App\Product;
use App\Tag;
use App\Category;
use App\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class BagController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bagAddBySession()
    {
        $product_id = Input::get('product_id');     // id du produit récupéré au click au moment d'ajouter un produit
        $quantity   = Input::get('quantity');

        Session::push("key.product_id", $product_id);
        Session::push("key.product_nb", $quantity +1);

        /////// je pense qu'il faudrait faire un "put" dans un foreach pour la gestion des supression des item ///////
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

        return redirect()->back()->with('message', 'Produit ajouté au panier');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bagShow()
    {
        if (Session::has('key')) {
            $bag_ids        = Session::get("key.product_id");   // contient plusieurs id
            $bag_nbs        = Session::get("key.product_nb");   // contient les quantites
            $tab_product    = [];                               // on stock les produits
            $tab_quantity   = [];                               // on stock les quantités
            $total_order    = 0;
            foreach ($bag_ids as $key => $idProduct) {
                $quantity       = $bag_nbs[$key];
                $product        = Product::where('id', $idProduct)->firstOrFail();
                $total_order    = $total_order + $product->price * $quantity;
                //echo $idProduct." -- ".$quantity."<br>";
                array_push($tab_product, $product);
                array_push($tab_quantity, $quantity);
            }
        }

        return view('front.panier.panier', compact('tab_product', 'tab_quantity', 'total_order'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bagConfirm()
    {
        if (Session::has('key')) {
            $bag_ids        = Session::get("key.product_id");   // contient plusieurs id
            $bag_nbs        = Session::get("key.product_nb");   // contient les quantités
            $tab_product    = [];                               // on stock les produits
            $tab_quantity   = [];                               // on stock les quantités
            $total_order    = 0;
            foreach ($bag_ids as $key => $idProduct) {
                $quantity       = $bag_nbs[$key];
                $product        = Product::where('id', $idProduct)->firstOrFail();
                $total_order    = $total_order + $product->price * $quantity;
                //echo $idProduct." -- ".$quantity."<br>";
                array_push($tab_product, $product);
                array_push($tab_quantity, $quantity);
            }
        }

        return view('front.panier.panier_confirm', compact('tab_product', 'tab_quantity', 'total_order'));
    }

    /**
     * @param LoginCustomerFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bagStore(LoginCustomerFormRequest $request)
    {
        /////////////////////// "AUTH" CLIENT ///////////////////////
        $customer_name  = Input::get('customer_name');
        $customer_email = Input::get('customer_email');

        // si username + email (provenant des inputs) match avec ceux de la bdd :
        $customer = Customer::whereRaw('username = ? and email = ?', [$customer_name, $customer_email])->first();

        if (!empty($customer)) {
            // on envois les datas en bdd :
            $order = Order::create($request->all());

            // id du client :
            $customer_id = $customer->id;
            $order->customer_id = $customer_id;

            // On va associer LA commande aux produits :
            $bag_ids = Session::get("key.product_id"); // contient l'id des produits
            $bag_nbs = Session::get("key.product_nb"); // contient la quantité des produits

            $order->save();

            $newItems = [];
            foreach ($bag_ids as $key => $idProduct) {
                $quantity   = $bag_nbs[$key];
                $newItems[] = [
                    'order_id'      => $order->id,
                    'product_id'    => $idProduct,
                    'quantity'      => $quantity
                ];
            }

            DB::table('order_product')->insert($newItems);

            // on vide le panier :
            Session::flush();

            return redirect(url('/'))->with('message', 'Votre commande à bien été pris en compte !');
        } else {
            return redirect()->back()->with('error', 'Erreur, nom d\'utilisateur ou mot de passe incorrect !');
        }

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bagDelete()
    {
        Session::forget("key");

        return redirect()->back()->with('message', 'Le produit à bien été suprimé');
    }

}