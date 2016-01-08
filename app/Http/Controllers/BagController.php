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
        $product    = Product::where('id', $product_id)->firstOrFail();

        Session::push('panier', [
                "quantity"      => $quantity,
                "product_id"    => $product_id,
                "title"         => $product->title,
                "image"         => isset($product->image->uri_mini) ? $product->image->uri_mini : '',
                "price"         => $product->price,
                "priceTotalByProduct" => $quantity * $product->price,
        ]);

        return redirect()->back()->with('message', 'Produit ajouté au panier');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bagShow()
    {
        if (Session::has('panier')) {
            $paniers = Session::get("panier");
            $total_order        = 0;
            $total_products     = 0;
            foreach ($paniers as $panier) {
                $price          = $panier["price"];
                $quantity       = $panier["quantity"];
                $total_order    = $total_order + ($price * $quantity);
                $total_products++;
            }
        }

        //dd($panier);
        return view('front.panier.panier', compact('paniers', 'total_order', 'total_products'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bagConfirm()
    {
        if (Session::has('panier')) {
            $paniers = Session::get("panier");
            $total_order        = 0;
            foreach ($paniers as $panier) {
                $price          = $panier["price"];
                $quantity       = $panier["quantity"];
                $total_order    = $total_order + ($price * $quantity);
            }
        }

        return view('front.panier.panier_confirm', compact('paniers', 'total_order'));
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
            $customer_id        = $customer->id;
            $order->customer_id = $customer_id;
            $order->save();

            // On va associer LA commande aux produits en bdd :
            $paniers = Session::get("panier");

            $newItems = [];
            foreach ($paniers as $panier) {
                $newItems[] = [
                    'order_id'      => $order->id,
                    'product_id'    => $panier["product_id"],
                    'quantity'      => $panier["quantity"]
                ];
            }

            DB::table('order_product')->insert($newItems);

            // on vide le panier :
            Session::forget('panier');

            return redirect(url('/'))->with('message', 'Votre commande à bien été pris en compte !');
        } else {
            return redirect()->back()->with('error', 'Erreur, nom d\'utilisateur ou mot de passe incorrect !');
        }

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function productDelete($key)
    {
        $panier = Session::get("panier");
        unset($panier[$key]);

        Session::put('panier', $panier);

        return redirect()->back()->with('message', 'Le produit a bien été suprimé');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bagDelete()
    {
        Session::forget('panier');

        return redirect()->back()->with('message', 'Le panier a bien été vidé');
    }

}
