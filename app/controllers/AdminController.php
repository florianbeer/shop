<?php

/**
 * Class AdminController
 */
class AdminController extends \BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('admin', ['only' => ['index']]);
    }

    /**
     * @internal param $lastMonth
     * @internal param $now
     * @return mixed
     */
    public static function getTotalsForLastMonth()
    {
        $now = Carbon::now()->setTime(00, 00, 00)->toDateTimeString();
        $lastMonth = Carbon::now()->subMonth(1)->toDateTimeString();

        return DB::select(DB::raw("SELECT sum(total) totals, DATE(created_at) day FROM orders
          WHERE created_at BETWEEN '$lastMonth' AND '$now'
          GROUP BY DAY(created_at) ORDER BY created_at ASC"
        ));
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $numUsers = User::count();
        $numProducts = Product::count();
        $numCategories = Category::count();
        $numProcessed = Order::processed()->count();
        $unprocessed = Order::orderBy('created_at', 'DESC')->unprocessed()->with('user')->get();
        $reports = self::getTotalsForLastMonth();
        $days = [];
        $totals = [];

        foreach ( $reports as $i => $report ) {
            $days[$i] = Carbon::createFromFormat('Y-m-d', $report->day)->formatLocalized(Config::get('shop.date-short'));
            $totals[$i] = (Float) $report->totals;
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
