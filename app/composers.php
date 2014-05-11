<?php

/*
|--------------------------------------------------------------------------
| Setting Locales
|--------------------------------------------------------------------------
|
*/

setlocale(LC_MONETARY, Config::get('shop.locale'));
setlocale(LC_TIME, Config::get('shop.locale'));


/*
|--------------------------------------------------------------------------
| View Composers
|--------------------------------------------------------------------------
|
*/

View::composer('partials._navbar', '\Shop\Composers\CategoriesComposer');
