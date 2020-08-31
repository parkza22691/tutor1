<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\ProductImage;
use DateTime;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\Auth;

use PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $Products = Product::all();

        // $Products = Product::orderBy('product_name', 'asc')->paginate(10)->onEachSide(1);

        // $Products = Product::join('product_image','product_image.product_id','product.product_id')->orderBy('product_name', 'asc')->paginate(10)->onEachSide(1);

        $Products = Product::leftJoin('product_image','product_image.product_id','=','product.product_id')->where('product.product_id', '>', 5)
        ->select('product.product_id', 'product.product_name', 'product.product_price', 'product.product_image', 'product.list_order')->paginate(10)->onEachSide(1);

        // Get the currently authenticated user...

        // $Products = Product::addSelect();

        // $Products = Product::leftJoin('product_image', function($join) {
        //   $join->on('product_image.product_id', '=', 'product.product_id');
        // })->select('product.product_id', 'product.product_name', 'product.product_price', 'product.product_image', 'product.list_order')->get();

        // return response()->json($Product);

        // var_dump($Products);

        return view('product.home',['Products' => $Products]);
        // return view('product.home');
    }
    public function create()
    {
        return view('product.form');
    }
    public function read(Request $request)
    {

      $product = Product::find($request->id);

      $product_image = ProductImage::where('product_id', $request->id)->get();
      // $product_image = ProductImage::all();

      return view('product.form',['Products' => $product , 'Image' => $product_image]);


    }
    public function insert(Request $request)
    {
      $product = new Product;
      $product->product_name = $request->product_name;
      $product->product_price = $request->product_price;
      $product->list_order = Product::max('list_order') + 1;

      if ($request->file('product_image')) {

        $guessExtension = $request->file('product_image')->guessExtension();

        $fileName = "ProductImage".date('Ymdhis').'.'.$guessExtension;

        $request->file('product_image')->storeAs('public/uploads', $fileName);

        $product->product_image = $fileName;

      } else {

        $product->product_image = "";

      }

      $product->save();
      $product_id = $product->product_id;

      if($request->file('product_image_oth')) {
        $i = 0;
        foreach ($request->file('product_image_oth') as $file) {
          $i++;
          $product_image = new ProductImage;

          $guessExtension = $file->guessExtension();
          $fileName = "ProductImageOth".date('Ymdhis')."-".$i.'.'.$guessExtension;
          $file->storeAs('public/uploads', $fileName);

          $product_image->product_id = $product_id;
          $product_image->product_image_name = $fileName;
          $product_image->save();

        }

      }

      return redirect('/product');
    }

    public function update(Request $request)
    {
      $product = Product::find($request->id);
      $product->product_name = $request->product_name;
      $product->product_price = $request->product_price;
      $product->save();
      return redirect('/product');
    }

    public function delete(Request $request)
    {
      Product::find($request->id)->delete();
      ProductImage::find($request->product_id)->delete();
      // return response("Success",200);
      return redirect('/product');
    }

    public function pdf()
    {
        $pdf = PDF::loadView('product.form');
        return @$pdf->stream();
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $product = new Product([
        'product_name' => $request->get('product_name'),
        'product_price' => $request->get('product_price')
      ]);
      $product->save();
      return redirect('/');

    }

}
