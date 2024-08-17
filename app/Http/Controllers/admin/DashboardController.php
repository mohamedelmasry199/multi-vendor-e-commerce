<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('check_permission:view_dashboard')->only(['index']);
    }
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('orders.status', 'done');

        if ($startDate) {
            $query->whereDate('orders.created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('orders.created_at', '<=', $endDate);
        }

        $items = $query->select(
            'categories.id as category_id',
            'categories.name_ar as category_name',
            'products.id as product_id',
            'products.name_ar as product_name',
            DB::raw('SUM(order_items.price * order_items.quantity) as total_sales'),
            DB::raw('SUM(order_items.quantity) as total_quantity'),
            DB::raw('DATE(orders.created_at) as order_date')
        )
        ->groupBy('categories.id', 'category_name', 'products.id', 'product_name', 'order_date')
        ->get();

        $totalSalesPerDay = $items->groupBy('order_date')->map(function ($dayItems) {
            return $dayItems->sum('total_sales');
        });

        $bestSellingProducts = $items->groupBy('product_id')
            ->map(function ($topItems) {
                $product = $topItems->first();
                return [
                    'name' => $product->product_name,
                    'total_sales' => $topItems->sum('total_sales')
                ];
            })
            ->sortByDesc('total_sales')
            ->take(5)
            ->values();

        $totalDays = $totalSalesPerDay->count();
        $totalSales = $totalSalesPerDay->sum();
        $averageDailySales = $totalDays > 0 ? $totalSales / $totalDays : 0;

        $currentMonth = now()->format('Y-m');
        $salesThisMonth = $items->filter(function ($item) use ($currentMonth) {
            return strpos($item->order_date, $currentMonth) === 0;
        })->sum('total_sales');

        $sortedItems = $items->sortByDesc('total_sales');
        $topCategories = $sortedItems->take(2);
        $otherCategories = $sortedItems->slice(2);
        $otherTotalSales = $otherCategories->sum('total_sales');

        $latestOrders = Order::with('user')->latest()->take(5)->get();
        $latestUsers = User::latest()->take(5)->get();
        $latestProducts = Product::latest()->take(5)->get();

        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalOrders = Order::count();

        $viewData = [
            'totalSales' => $totalSales,
            'averageDailySales' => $averageDailySales,
            'topCategories' => $topCategories,
            'otherTotalSales' => $otherTotalSales,
            'topCategoriesData' => $topCategories->pluck('total_sales')->toArray(),
            'otherTotalSalesData' => $otherTotalSales,
            'salesData' => $totalSalesPerDay->toArray(),
            'salesThisMonth' => $salesThisMonth,
            'latestOrders' => $latestOrders,
            'latestUsers' => $latestUsers,
            'latestProducts' => $latestProducts,
            'bestSellingProducts' => $bestSellingProducts,
            'totalCategories' => $totalCategories,
            'totalProducts' => $totalProducts,
            'totalUsers' => $totalUsers,
            'totalOrders' => $totalOrders,
        ];

        return view('admin.dashboard.index', $viewData);
    }









}
