<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Tag;
use App\Category;
use App\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{

    public function index()
    {
        //$products = Product::where('status', true)->orderBy('published_at', 'desc')->with('category', 'tags', 'image')->paginate(10);
        $products = Product::where('status', true)->orderBy('published_at', 'desc')->with('category', 'tags', 'image')->paginate(10);

        return view('front.products.index', compact('products'));
    }


    public function show($id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        return view('front.products.show', compact('product'));
    }


    //////////////////////////////// SHOW CATEGORIES / TAGS BY POSTS ////////////////////////////////
    public function showProductByCategory($id)
    {
      //$products = Product::where('category_id', '=', $id)->paginate(10);
        $products = Product::whereRaw("category_id = $id and status = true")->paginate(10);
        return view('front.categories.index', compact('products'));
    }


    public function showProductByTag($id)
    {
        $products = Tag::find($id)->products; // TODO: Voir probleme de l'ajout d'un "where status(in table products) = true"
        return view('front.tags.index', compact('products'));
    }


    //////////////////////////////// GESTION DES MAILS ////////////////////////////////
    public function showContact()
    {
        return view('front.contact.contact');
    }

    public function sendContact(ContactFormRequest $request)
    {
        // $message        = $request->all()['message'];
        // $email          = $request->all()['email'];
        // $category_id    = $request->all()['category_id'];

        // $contents = [
        //     'message'       => $request->input('message'),
        //     'email'         => $request->input('email'),
        //     'category_id'   => $request->input('category_id')
        // ];

        $contents = $request->all();

        Mail::send('emails.email', compact('contents'), function($message) use ($request) {
            $message->from('hicode@hicode.fr', 'Laravel');
            $message->to('pierremartin.pro@gmail.com')->cc('bar@exemple.com');
        });
    }

    //////////////////////////////// PAGE MENTIONS LEGALS ////////////////////////////////
    public function showTerms()
    {
        return view('front.terms.terms');
    }

    //////////////////////////////// PAGE PANIER ////////////////////////////////
    public function bag()
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


    public function bagDelete($id)
    {
        //Session::forget('key');

        $bag_ids  = Session::get('key.product_id'); // contient plusieurs id
        $bag_nbs  = Session::get('key.product_nb');


        var_dump('<pre>');
        var_dump($bag_ids, $bag_nbs);
        var_dump('</pre>');

        Session::forget("key");

        return redirect()->back()->with('message', 'Le produit à bien été suprimé');
    }




    public function bagConfirm()
    {
        $bag_ids = Session::get('key.product_id'); // contient plusieurs id
        $bag_nbs = Session::get('key.product_nb');

        $tab_ids = [];
        foreach($bag_ids as $key_id => $val_id) // on liste chaque product_id dans $val_id
        {
            //echo "<b>$key_id</b> : $val_id<br>";
            array_push($tab_ids, Product::where('id', $val_id)->firstOrFail());
        }


        $tab_nbs = [];
        foreach($bag_nbs as $key_nb => $val_nb)
        {
            array_push($tab_nbs, $val_nb);
        }

        //$product = Product::where('id', $bag_id)->firstOrFail();

        return view('front.panier.panier_confirm', compact('tab_ids', 'tab_nbs'));
    }

}
