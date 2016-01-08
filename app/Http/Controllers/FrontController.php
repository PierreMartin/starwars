<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ContactFormRequest; // add
use App\Http\Controllers\Controller;
use App\Product;
use App\Tag;
use App\Category;
use App\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Mail;

class FrontController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::where('status', true)->orderBy('published_at', 'desc')->with('category', 'tags', 'image')->paginate(10);

        return view('front.products.index', compact('products'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        return view('front.products.show', compact('product'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * SHOW PRODUCTS BY CATEGORIES
     */
    public function showProductByCategory($id)
    {
        $products = Product::whereRaw("category_id = $id and status = true")->orderBy('published_at', 'desc')->with('category', 'tags', 'image')->paginate(10);

        if ($id == 1) {
            $cat_product = "sabres lasers";
        } elseif ($id == 2) {
            $cat_product = "casques";
        }

        return view('front.categories.index', compact('products', 'cat_product'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * SHOW PRODUCTS BY TAGS
     */
    public function showProductByTag($id)
    {
        $products = Tag::find($id)->products->where('status', 1);

        return view('front.tags.index', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * PAGE CONTACT
     */
    public function showContact()
    {
        return view('front.contact.contact');
    }

    /**
     * @param ContactFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * PAGE CONTACT - SEND MESSAGE
     */
    public function sendContact(ContactFormRequest $request)
    {
        $messageMain    = $request->input('message');
        $email          = $request->input('email');

        \Akismet::setCommentContent($request->input('message'))
            ->setCommentAuthorEmail($request->input('email'))
            ->setCommentAuthorUrl($request->url());
        if (\Akismet::isSpam()) {
            return redirect()->back()->with('error', 'Message considéré comme du spam ! Merci d\'envoyer un message sans intentions commerciales');
        } else {
            Mail::send('emails.email', compact('messageMain', 'email'), function($message) use ($request) {
                $message->from('hicode@hicode.fr', 'Laravel');
                $message->to('pierremartin.pro@gmail.com')->cc('bar@exemple.com');
            });

            return redirect()->back()->with('message', 'Message envoyé');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * PAGE MENTIONS LEGALS
     */
    public function showTerms()
    {
        return view('front.terms.terms');
    }

}
