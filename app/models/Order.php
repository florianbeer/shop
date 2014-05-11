<?php

class Order extends Eloquent {
  
  protected $fillable = ['user_id', 'subtotal', 'total', 'items', 'processed'];
  
  public static $rules = [
    'user_id' => 'required|integer',
    'subtotal' => 'required|float',
    'total' => 'required|float',
    'items' => 'required',
  ];
  
  public function user() {
    return $this->belongsTo('User');
  }
  
  public function scopeProcessed($query)
  {
    return $query->whereProcessed(1);
  }
  
  public function scopeUnprocessed($query)
  {
    return $query->whereProcessed(0);
  }
  
}