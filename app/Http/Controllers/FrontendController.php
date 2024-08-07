<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;


class FrontendController extends Controller
{
    public function index()
    {

        return view('frontend.index', [
            'categories' => Category::all(),
            'products' => Product::latest()->get(),
        ]);
    }

    public function productdetails ($id)
    {
        $product = Product::findOrfail($id);
        
        $sizes = explode(',', $product->size);

        $related_products = Product::where('category_id', $product->category_id)->where('id', '!=', $id)->get();
        return view('frontend.product_details', compact('product', 'related_products', 'sizes'));
    }

    public function about()
    {
        return view('frontend.about');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
    public function contactformpost(Request $request)
    {
        // return $request->except('_token');

        Mail::to('fahim.raafi1990@gmail.com')->send(new ContactMail());
    }

    public function account()
    {
        return view('frontend.account');
    }
}
