<?php

class AdminController extends \BaseController {

  public function __construct() {
    parent::__construct();
    $this->beforeFilter('admin', ['only' => ['index']]);
  }

	/**
	 * Displays the Admin Dashboard.
	 * GET /admin
	 *
	 * @return Response
	 */
	public function index()
	{
		$numUsers = User::count();
    $numProducts = Product::count();
    $numCategories = Category::count();
    $numProcessed = Order::processed()->count();
    $unprocessed = Order::orderBy('created_at', 'DESC')->unprocessed()->with('user')->get();
    $now = Carbon::now()->setTime(00,00,00)->toDateTimeString();
    $lastMonth = Carbon::now()->subMonth(1)->toDateTimeString();
    $reports = DB::select(DB::raw("SELECT sum(total) totals, DATE(created_at) day FROM orders 
      WHERE created_at BETWEEN '$lastMonth' AND '$now'
      GROUP BY DAY(created_at) ORDER BY created_at ASC"
    ));
    $days = [];
    $totals = [];

    foreach ($reports as $i => $report) {
      $days[$i] = Carbon::createFromFormat('Y-m-d', $report->day)->formatLocalized(Config::get('shop.date-short'));
      $totals[$i] = (Float)$report->totals;
    }

    return View::make('admin.index')
      ->withNumusers($numUsers)
      ->withNumproducts($numProducts)
      ->withNumcategories($numCategories)
      ->withNumprocessed($numProcessed)
      ->withUnprocessed($unprocessed)
      ->withTotals($totals)
      ->withDates($days)
      ->withTitle(Lang::get('admin.dashboard'));
	}

}