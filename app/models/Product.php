<?php

Class Product extends Eloquent {
  
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
    'price' => 'required',
    'tax' => 'required',
    'availability' => 'integer',
    'image' => 'required|image|mimes:jpeg,jpg,png,gif'
  ];
  
  public function category() {
    return $this->belongsTo('Category');
  }
  
}