<?php

Class Product extends \Eloquent {
  
  protected $fillable = [
    'category_id',
    'title',
    'description',
    'price',
    'tax',
    'availability',
    'image'
  ];
  
  public static $rules = [
    'category_id' => 'required|integer',
    'title' => 'required|min:2',
    'description' => 'required|min:20',
    'price' => 'required|digits_between:3,10',
    'tax' => 'required|numeric',
    'availability' => 'integer',
    'image' => 'required|image|mimes:jpeg,jpg,png,gif'
  ];
  
  public static $updateRules = [
    'category_id' => 'required|integer',
    'title' => 'required|min:2',
    'description' => 'required|min:20',
    'price' => 'required|digits_between:3,10',
    'tax' => 'required|numeric',
    'availability' => 'integer',
    'image' => 'image|mimes:jpeg,jpg,png,gif'    
  ];
  
  public function setPriceAttribute($price)
  {
    $this->attributes['price'] = str_replace(',', '.', $price);
  }
  
  public function getPriceAttribute($price)
  {
    return money_format('%!.2n', $price);
  }
  
  public function category()
  {
    return $this->belongsTo('Category');
  }
  
  public function scopeSearch($query, $keyword)
  {
    return $query->orderBy('created_at', 'DESC')
      ->inStock()
      ->where('title', 'LIKE', '%'.$keyword.'%')
      ->paginate(Config::get('shop.items-per-page'));
  }
  
  public function scopeFeatured($query)
  {
    return $query->inStock()->whereFeatured(1);
  }
  
  public function scopeInStock($query)
  {
    return $query->whereAvailability(1);
  }
  
  public function scopeOutOfStock($query)
  {
    return $query->whereAvailability(0);
  }
}