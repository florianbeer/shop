<?php

class Category extends \Eloquent {
  
  protected $fillable = ['name'];
  
  public static $rules = [
    'name' => 'required|min:3'
  ];
  
  public function products() {
    return $this->hasMany('Product');
  }
  
}