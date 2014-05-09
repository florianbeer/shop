<?php

class ProductsController extends BaseController {
  
  public function getIndex($filter = null) {
    if (Request::get('page')) {
      Session::put('page', Input::get('page'));
    } else {
      Session::forget('page');
    }

    if ($filter === 'featured') {
      $products = Product::where('featured', 1)->orderBy('created_at', 'DESC')->paginate(10);
    } else if ($filter === 'outofstock') {
      $products = Product::where('availability', 0)->orderBy('created_at', 'DESC')->paginate(10);
    } else {
      $products = Product::orderBy('created_at', 'DESC')->paginate(10);
    }

    return View::make('products.index')
      ->with('title', 'Products')
      ->with('categories', Category::orderBy('created_at', 'DESC')->lists('name', 'id'))
      ->with('filter', $filter)
      ->with('products', $products);
  }
  
  public function postCreate() {
    $validator = Validator::make(Input::all(), Product::$rules);
    
    if ($validator->passes()) {
      $product = new Product;
      $product->category_id = Input::get('category_id');
      $product->title = Input::get('title');
      $product->description = Input::get('description');
      $product->price = str_replace(',', '.', Input::get('price'));
      
      $image = Input::file('image');
      $filename = date('Y-m-d-H:i:s').'-'.$image->getClientOriginalName();
      Image::make($image->getRealPath())->save(public_path().'/img/products/'.$filename);
      $product->image = 'img/products/'.$filename;

      $product->save();
      
      return Redirect::to('admin/products/index')
        ->with('message', 'Product created');
    }
    
    return Redirect::to('admin/products/index')
      ->withErrors($validator)
      ->withInput();
  }
  
  public function postDestroy() {
    $product = Product::find(Input::get('id'));
    
    if ($product) {
      File::delete('public/'.$product->image);
      $product->delete();
      return Redirect::to('admin/products/index')
        ->with('message', 'Product deleted');
    }
    
    return Redirect::to('admin/products/index')
      ->with('message', 'Product not found');  
  }
  
  public function postToggleAvailability() {
    $product = Product::find(Input::get('id'));
 
    if ($product) {
 
      $product->availability = Input::get('availability');
      $product->save();

 
      return Redirect::back()
        ->with('message', 'Product updated');
    }
    
    return Redirect::to('/admin/products/index')
      ->with('message', 'Product not found');
 
  }
  
  public function getToggleFeatured($id) {
    $product = Product::find($id);
    
    if ($product) {
      $product->featured = !$product->featured;
      $product->save();

      return Redirect::back();
    }

    return Redirect::to('/admin/products/index')
      ->with('message', 'Product not found');
          
  }
   
}