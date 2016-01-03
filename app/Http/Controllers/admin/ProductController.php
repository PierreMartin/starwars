<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ProductFormRequest; // add
use App\Http\Controllers\Controller;

use App\Product;
use App\Image;
use App\Tag;
use App\Category;
use Form;
use \Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

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
        $time       = Carbon::now()->format('d-m-Y');

        return view('back.products.create', compact('categories', 'tags', 'time'));
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

        // gestion du champ date : // 02-01-2016 (vue) => 2016-01-02 (bdd)
        $t      = Input::get('published_at');       // string
        $time   = Carbon::createFromFormat('d-m-Y', $t)->toDateTimeString();
        $product->published_at = $time;

        // gestion du checkbox boolean 'en ligne?' :
        $product->status = (empty($request->input('status')))? 0 : 1;
        $product->save();

        // envoi des tags a la bdd :
        if( !empty($request->input('tags')) ) {
            $product->tags()->sync($request->get('tags'));
        }


        if ( Input::hasFile('image') ) {
            $destinationPath1   = 'uploads/main/';
            $destinationPath2   = 'uploads/preview/';
            $extension          = Input::file('image')->getClientOriginalExtension();
            $fileName1          = Str::random(10) . Carbon::now()->timestamp . '.'.$extension;
            $fileName2          = Str::random(10) . Carbon::now()->timestamp . '.'.$extension;

            \Intervention\Image\Facades\Image::make(Input::file('image')->getRealPath())
                // big
                ->fit(600, 450)
                ->save($destinationPath1 . $fileName1)
                // preview
                ->fit(180, 180)
                ->save($destinationPath2 . $fileName2);


            // on insere un champ 'uri' + 'uri_preview' dans la bdd 'images' :
            $image              = Image::create($request->all());
            $image->uri         = $fileName1;
            $image->uri_preview = $fileName2;
            $image->status      = 1; // 1 pour validé
            $image->save();

            // on insere un champ 'id' dans la bdd 'posts' :
            $image_id           = $image->id;
            $product->image_id  = $image_id;
            $product->save();
        }

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
        $product        = Product::findOrFail($id);
        $categories     = Category::lists('title', 'id');
        $tags           = Tag::get();

        $timeFromInput  = $product->published_at;
        $time = Carbon::parse($timeFromInput)->format('d-m-Y');

        return view('back.products.edit', compact('product', 'categories', 'tags', 'time'));
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

        // gestion du champ date : // 02-01-2016 (vue) => 2016-01-02 (bdd)
        $t      = Input::get('published_at');       // string
        $time   = Carbon::createFromFormat('d-m-Y', $t)->toDateTimeString();
        $product->published_at = $time;

        // gestion du checkbox boolean 'en ligne?' :
        $product->status = (empty($request->input('status')))? 0 : 1;
        $product->save();

        // envoi des tags a la bdd :
        if( !empty($request->input('tags')) ) {
            $product->tags()->sync($request->get('tags'));
        }


        if ( Input::hasFile('image') ) {
            $destinationPath1   = 'uploads/main/';
            $destinationPath2   = 'uploads/preview/';
            $extension          = Input::file('image')->getClientOriginalExtension();
            $fileName1          = Str::random(10) . Carbon::now()->timestamp . '.'.$extension;
            $fileName2          = Str::random(10) . Carbon::now()->timestamp . '.'.$extension;

            \Intervention\Image\Facades\Image::make(Input::file('image')->getRealPath())
                // big
                ->fit(600, 450)
                ->save($destinationPath1 . $fileName1)
                // preview
                ->fit(180, 180)
                ->save($destinationPath2 . $fileName2);


            // on insere un champ 'uri' + 'uri_preview' dans la bdd 'images' :
            $image              = Image::create($request->all());
            $image->uri         = $fileName1;
            $image->uri_preview = $fileName2;
            $image->status      = 1; // 1 pour validé
            $image->save();

            // on insere un champ 'id' dans la bdd 'posts' :
            $image_id           = $image->id;
            $product->image_id  = $image_id;
            $product->save();
        }

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
