<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
  {
		$numUsers = User::count();
    $numProducts = Product::count();
    $numCategories = Category::count();
    $numProcessed = Order::where('processed', '=', 1)->count();
    $unprocessed = Order::orderBy('created_at', 'DESC')->with('user')->where('processed', '=', 0)->get();
    $now = Carbon::now()->setTime(00,00,00)->toDateTimeString();
    $lastMonth = Carbon::now()->subMonth(1)->toDateTimeString();
    $reports = DB::select(DB::raw("
      SELECT sum(total) totals, DATE(created_at) day FROM orders 
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
      ->with('totals', $totals)
      ->with('dates', $days)
      ->with('unprocessed', $unprocessed)
      ->with('numProcessed', $numProcessed)
      ->with('numCategories', $numCategories)
      ->with('numProducts', $numProducts)
      ->with('numUsers', $numUsers)
      ->with('title', 'Dashboard');
    
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
