<?php

class CategoriesController extends BaseController {
    
  public function getIndex() {
    return View::make('categories.index')
      ->with('title', 'Categories')
      ->with('categories', Category::orderBy('created_at', 'DESC')->get());
  }
  
  public function postCreate() {
    $validator = Validator::make(Input::all(), Category::$rules);
    
    if ($validator->passes()) {
      $category = new Category;
      $category->name = Input::get('name');
      $category->save();
      
      return Redirect::to('admin/categories/index')
        ->with('message', 'Category created');
    }
    
    return Redirect::to('admin/categories/index')
      ->with('message', 'Something went wrong')
      ->withErrors($validator)
      ->withInput();
  }
  
  public function postDestroy() {
    $category = Category::find(Input::get('id'));
    
    if ($category) {
      $category->delete();
      return Redirect::to('admin/categories/index')
        ->with('message', 'Category deleted');
    }
    
    return Redirect::to('admin/categories/index')
      ->with('message', 'Category not found');  
  }
  
}