<?php

namespace App\Http\Controllers\Admins;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;

class DashboardController extends Controller
{
    protected $classActive = "Thống Kê"; //Dùng để thêm class active vào thẻ <li> ở sidebar

    //Dashboard admin
    public function index(Request $request){
        $day = $request->input('day') && $request->input('day') != 0 ? $request->input('day') : false;
        $month = $request->input('month') && $request->input('month') != 0 ? $request->input('month') : false;
        $year = $request->input('year') && $request->input('year') != 0 ? $request->input('year') : false;
        $countCxn = Order::where('status', 'cxn')->count();
        $countDxn = Order::where('status', 'dxn')->count();
        $countDgh = Order::where('status', 'dgh')->count();
        $countGhtc = Order::whereIn('status', ["ghtc", "dndh"])->count();
        $countGhtb = Order::where('status', 'ghtb')->count();
        $countDh = Order::where('status', 'dh')->count();
        $years = Order::select(DB::raw('YEAR(created_at) as year'))
        ->distinct()
        ->orderByDesc('year')
        ->pluck('year')
        ->toArray();
        $query = Order::whereIn('status', ['ghtc', 'dndh']);
        $this->filter($query, $day, $month, $year);
        $revenue = $query->sum('total_price');
        $query = Order::whereIn('status', ['ghtc', 'dndh']);
        $this->lastFilter($query, $day, $month, $year);
        $lastRevenue = $query->sum('total_price');
        $query = OrderDetail::whereHas('order', function($query) use ($day, $month, $year) {
            $query->whereIn('status', ['ghtc', 'dndh']);
            $this->filter($query, $day, $month, $year);
        });
        $profit = $query->sum(DB::raw('(price - import_price) * quantity'));
        $query = OrderDetail::whereHas('order', function($query) use ($day, $month, $year) {
            $query->whereIn('status', ['ghtc', 'dndh']);
            $this->lastFilter($query, $day, $month, $year);
        });
        $lastProfit = $query->sum(DB::raw('(price - import_price) * quantity'));
        $query = order::query();
        $this->filter($query, $day, $month, $year);
        $order = $query->count();
        $orderSuccess = $query->whereIn('status', ["ghtc", "dndh"])->count();
        $query = order::query();
        $this->lastFilter($query, $day, $month, $year);
        $lastOrder = $query->count();
        $lastOrderSuccess = $query->whereIn('status', ["ghtc", "dndh"])->count();
        $query = Product::withSum(['orderDetails' => function ($query) use ($day, $month, $year) {
            $query->whereHas('order', function ($query) use ($day, $month, $year) {
                $query->whereIn('status', ['ghtc', 'dndh']);
                $this->filter($query, $day, $month, $year);
            });
        }], 'quantity');
        $topbestSellingProducts = $query->having('order_details_sum_quantity', '>', 0)
        ->orderByDesc('order_details_sum_quantity')
        ->orderByDesc('created_at')
        ->take($request->input('topSelling') ?? 5)
        ->get();
        $query = Product::withSum(['orderDetails' => function ($query) use ($day, $month, $year) {
            $query->whereHas('order', function ($query) use ($day, $month, $year) {
                $query->whereIn('status', ['ghtc', 'dndh']);
                $this->filter($query, $day, $month, $year);
            })->select(DB::raw('SUM(price * quantity)'));
        }], 'price');
        $tophighestRevenueProducts = $query->having('order_details_sum_price', '>', 0)
        ->orderByDesc('order_details_sum_price')
        ->orderByDesc('created_at')
        ->take($request->input('topRevenue') ?? 5)
        ->get();
        $query = Product::withSum(['orderDetails' => function ($query) use ($day, $month, $year) {
            $query->whereHas('order', function ($query) use ($day, $month, $year) {
                $query->whereIn('status', ['ghtc', 'dndh']);
                $this->filter($query, $day, $month, $year);
            })->select(DB::raw('SUM((price - import_price) * quantity)'));
        }], 'price');
        $tophighestProfitProducts = $query->having('order_details_sum_price', '>', 0)
        ->orderByDesc('order_details_sum_price')
        ->orderByDesc('created_at')
        ->take($request->input('topProfit') ?? 5)
        ->get();
        // chart
        $chartTime = $this->chartTime($day, $month, $year);
        $chartRevenue = $this->chartRevenue($day, $month, $year);
        $chartProfit = $this->chartProfit($day, $month, $year);
        $unit = $year && !$month && !$day ? "Tháng" : ($year && $month && !$day ? "Ng" : ($year && $month && $day ? "giờ" : "Năm"));
        $chartTimeUnit = array_map(function($item) use ($unit){
            if($unit == "giờ"){
                return $item ." ". $unit;
            }else{
                return $unit ." ". $item;
            }
        }, $chartTime);
        $template = 'admins.dashboards.index'; //Tạo biến template để include vào content của layout
        return view('admins.layout', [
        'title' => 'Admin',
        'template' => $template,
        'classActive' => $this->classActive,
        'countCxn' => $countCxn,
        'countDxn' => $countDxn,
        'countDgh' => $countDgh,
        'countGhtc' => $countGhtc,
        'countGhtb' => $countGhtb,
        'countDh' => $countDh,
        'years' => $years,
        'revenue' => $revenue,
        'profit' => $profit,
        'lastRevenue' => $lastRevenue,
        'lastProfit' => $lastProfit,
        'order' => $order,
        'lastOrder' => $lastOrder,
        'orderSuccess' => $orderSuccess,
        'lastOrderSuccess' => $lastOrderSuccess,
        'topbestSellingProducts' => $topbestSellingProducts,
        'tophighestRevenueProducts' => $tophighestRevenueProducts,
        'tophighestProfitProducts' => $tophighestProfitProducts,
        'chartTimeUnit' => $chartTimeUnit,
        'unit' => $unit,
        'chartRevenue' => $chartRevenue,
        'chartProfit' => $chartProfit
    ]);
    }

    public function filter($query, $day, $month, $year){
        $day ? $query->whereDay('created_at', $day) : "";
        $month ? $query->whereMonth('created_at', $month) : "";
        $year ? $query->whereYear('created_at', $year) : "";
    }

    public function lastFilter($query, $day, $month, $year){

        $orderYear = Order::select(DB::raw('YEAR(created_at) as year'))
        ->orderBy('year', 'asc')
        ->first()
        ->year;
        if($year && $year != $orderYear  && !$month && !$day){
            $year = Order::select(DB::raw('YEAR(created_at)'))->whereYear('created_at', '<', $year)
            ->orderBy('created_at', 'desc')
            ->pluck(DB::raw('YEAR(created_at)'))->first();
            $query->whereYear('created_at', $year);
        }elseif($year && $month && $month !== "01" && !$day){
            $month = Order::select(DB::raw('MONTH(created_at)'))->whereMonth('created_at', '<', $month)
            ->orderBy('created_at', 'desc')
            ->pluck(DB::raw('MONTH(created_at)'))->first();
            $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
        }elseif($year && $month && $day && $day !== "01"){
            $day = Order::select(DB::raw('DAY(created_at)'))->whereDay('created_at', '<', $day)
            ->orderBy('created_at', 'desc')
            ->pluck(DB::raw('DAY(created_at)'))->first();
            $query->whereYear('created_at', $year)->whereMonth('created_at', $month)->whereDay('created_at', $day);
        }else{
            $day ? $query->whereDay('created_at', $day) : "";
            $month ? $query->whereMonth('created_at', $month) : "";
            $year ? $query->whereYear('created_at', $year) : "";
        }
    }

    public function chartTime($day, $month, $year){
        if($year && !$month && !$day){
            $chartTime = Order::select(DB::raw('MONTH(created_at) as month'))
            ->where('orders.payment_status', 'dtt')
            ->whereYear('created_at', $year)
            ->distinct()
            ->orderBy('month')
            ->pluck('month')
            ->toArray();
        }elseif($year && $month && !$day){
            $chartTime = Order::select(DB::raw('DAY(created_at) as day'))
            ->where('orders.payment_status', 'dtt')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->distinct()
            ->orderBy('day')
            ->pluck('day')
            ->toArray();
        }elseif($year && $month && $day){
            $chartTime = Order::select(DB::raw('HOUR(created_at) as hour'))
            ->where('orders.payment_status', 'dtt')
            ->whereDay('created_at', $day)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->distinct()
            ->orderBy('hour')
            ->pluck('hour')
            ->toArray();
        }else{
            $chartTime = Order::select(DB::raw('YEAR(created_at) as year'))
            ->where('orders.payment_status', 'dtt')
            ->distinct()
            ->orderBy('year')
            ->pluck('year')
            ->toArray();
        }
        return $chartTime;
    }

    public function chartRevenue($day, $month, $year){
      if($year && !$month && !$day){
        $chartRevenue = Order::select(DB::raw('SUM(total_price)'))
        ->where('payment_status', 'dtt')
        ->whereYear('created_at', $year)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->pluck(DB::raw('SUM(total_price)'))
        ->toArray();
      }elseif($year && $month && !$day){
        $chartRevenue = Order::select(DB::raw('SUM(total_price)'))
        ->where('payment_status', 'dtt')
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->groupBy(DB::raw('DAY(created_at)'))
        ->orderBy(DB::raw('DAY(created_at)'))
        ->pluck(DB::raw('SUM(total_price)'))
        ->toArray();
      }elseif($year && $month && $day){
        $chartRevenue = Order::select(DB::raw('SUM(total_price)'))
        ->where('payment_status', 'dtt')
        ->whereDay('created_at', $day)
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->groupBy(DB::raw('HOUR(created_at)'))
        ->orderBy(DB::raw('HOUR(created_at)'))
        ->pluck(DB::raw('SUM(total_price)'))
        ->toArray();
      }else{
        $chartRevenue = Order::select(DB::raw('SUM(total_price)'))
        ->where('payment_status', 'dtt')
        ->groupBy(DB::raw('YEAR(created_at)'))
        ->orderBy(DB::raw('YEAR(created_at)'))
        ->pluck(DB::raw('SUM(total_price)'))
        ->toArray();
      }
      return $chartRevenue;
    }

    public function chartProfit($day, $month, $year){
        if($year && !$month && !$day){
            $chartProfit = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select(DB::raw('SUM((order_details.price - order_details.import_price) * order_details.quantity) as profit'))
            ->where('orders.payment_status', 'dtt')
            ->whereYear('orders.created_at', $year)
            ->groupBy(DB::raw('MONTH(orders.created_at)'))
            ->orderBy(DB::raw('MONTH(orders.created_at)'))
            ->pluck('profit')
            ->toArray();
        }elseif($year && $month && !$day){
            $chartProfit = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select(DB::raw('SUM((order_details.price - order_details.import_price) * order_details.quantity) as profit'))
            ->where('orders.payment_status', 'dtt')
            ->whereMonth('orders.created_at', $month)
            ->whereYear('orders.created_at', $year)
            ->groupBy(DB::raw('DAY(orders.created_at)'))
            ->orderBy(DB::raw('DAY(orders.created_at)'))
            ->pluck('profit')
            ->toArray();
        }elseif($year && $month && $day){
            $chartProfit = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select(DB::raw('SUM((order_details.price - order_details.import_price) * order_details.quantity) as profit'))
            ->where('orders.payment_status', 'dtt')
            ->whereDay('orders.created_at', $day)
            ->whereMonth('orders.created_at', $month)
            ->whereYear('orders.created_at', $year)
            ->groupBy(DB::raw('HOUR(orders.created_at)'))
            ->orderBy(DB::raw('HOUR(orders.created_at)'))
            ->pluck('profit')
            ->toArray();
        }else{
            $chartProfit = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select(DB::raw('SUM((order_details.price - order_details.import_price) * order_details.quantity) as profit'))
            ->where('orders.payment_status', 'dtt')
            ->groupBy(DB::raw('YEAR(orders.created_at)'))
            ->orderBy(DB::raw('YEAR(orders.created_at)'))
            ->pluck('profit')
            ->toArray();
        }
        return $chartProfit;
    }
}
