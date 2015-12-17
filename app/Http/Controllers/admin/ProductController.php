<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ProductFormRequest; // add
use App\Http\Controllers\Controller;

use App\Product;
use App\Tag;
use App\Category;
use Form;
use \Carbon\Carbon;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category', 'tags')->paginate(10);

        return view('back.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('title', 'id');
        //$tags       = Tag::lists('name', 'id');
        $tags       = Tag::get();

        return view('back.products.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        $product = Product::create($request->all());

        // gestion du checkbox boolean 'en ligne?' :
        $product->status = (empty($request->input('status')))? 0 : 1;

        // envoi des tags a la bdd :
        if( !empty($request->input('tags')) ) {
            $product->tags()->sync($request->get('tags'));
        }

/*        // FILES :
        $file   = array('image' => Input::file('image'));
        $rules  = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000

        //if ( !empty($_POST['image']) ) {
        if (Input::file('image')->isValid()) {
            $destinationPath = 'uploads';
            $extension = Input::file('image')->getClientOriginalExtension();
            $fileName = rand(11111,99999).'.'.$extension;
            Input::file('image')->move($destinationPath, $fileName);

            // on insere un champ 'name' dans la bdd 'images' :
            $image = Image::create($request->all());
            $image->name = $fileName;
            $image->save();

            // on insere un champ 'id' dans la bdd 'posts' :
            $image_id = $image->id;
            $product->image_id = $image_id;
            $product->save();
        } else {
            return redirect(route('admin.products.edit', $product))->with('message', 'Erreur : l\'image n\'est pas bonne');
            die();
        }
        //}*/

        return redirect(route('admin.products.edit', $product))->with('message', 'Le produit à bien été créer ! Vous pouvez maitenant le modifier');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::lists('title', 'id');
        $tags       = Tag::get();

        return view('back.products.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        // gestion du checkbox boolean 'en ligne?' :
        $product->status = (empty($request->input('status')))? 0 : 1;
        $product->save();

        // envoi des tags a la bdd :
        if( !empty($request->input('tags')) ) {
            $product->tags()->sync($request->get('tags'));
        }

        /*// FILES :
        $file   = array('image' => Input::file('image'));
        $rules  = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000

        //if ( !empty($_POST['image']) ) {
        if (Input::file('image')->isValid()) {
            $destinationPath = 'uploads';
            $extension = Input::file('image')->getClientOriginalExtension();
            $fileName = rand(11111,99999).'.'.$extension;
            Input::file('image')->move($destinationPath, $fileName);

            // on insere un champ 'name' dans la bdd 'images' :
            $image = Image::create($request->all());
            $image->name = $fileName;
            $image->save();

            // on insere un champ 'id' dans la bdd 'posts' :
            $image_id = $image->id;
            $product->image_id = $image_id;
            $product->save();
        } else {
            return redirect(route('admin.posts.edit', $post))->with('message', 'Erreur : l\'image n\'est pas bonne');
            die();
        }
        //}*/

        return redirect(route('admin.products.edit', $id))->with('message', 'Le produit à bien été modifier !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();

        return redirect()->to('admin/products/')->with('message', 'Le produit à bien été suprimé !');
    }
}
