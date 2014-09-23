<?php namespace Shop\Creators;

use Validator;
use Product;
use Input;
use Image;
use File;

/*
 * ProductCreator
 *
 * Creates and updates Product model instances and
 * takes care of image manipulations.
 *
 */

/**
 * Class ProductCreator
 * @package Shop\Creators
 */
class ProductCreator {

    /**
     * @var
     */
    protected $listener;

    /**
     * @param $listener
     */
    public function __construct($listener)
    {
        $this->listener = $listener;
    }

    /**
     * @param $input
     * @param Product $product
     * @return mixed
     */
    public function create($input, Product $product = false)
    {
        if ( $product ) $validation = Validator::make($input, Product::$updateRules);
        else          $validation = Validator::make($input, Product::$rules);

        if ( $validation->fails() ) {
            return $this->listener->productCreationFails($validation);
        }

        if ( Input::file('image') ) {
            if ( $product ) {
                File::delete(public_path() . DIRECTORY_SEPARATOR . $product->image);
                File::delete(public_path() . DIRECTORY_SEPARATOR . str_replace('img/products/', 'img/products/thumb-', $product->image));
                File::delete(public_path() . DIRECTORY_SEPARATOR . str_replace('img/products/', 'img/products/small-', $product->image));
            }

            $image = Input::file('image');
            $filename = time() . '-' . $image->getClientOriginalName();
            Image::make($image->getRealPath())->resize('480', null, true)->save(public_path() . '/img/products/' . $filename);
            Image::make($image->getRealPath())->resize('128', null, true)->save(public_path() . '/img/products/thumb-' . $filename);
            Image::make($image->getRealPath())->resize('50', null, true)->save(public_path() . '/img/products/small-' . $filename);
            $input['image'] = 'img/products/' . $filename;
        } else {
            $input['image'] = $product->image;
        }

        if ( $product ) {
            $product->update($input);
        } else {
            Product::create($input);
        }

        return $this->listener->productCreationSucceeds();
    }

}