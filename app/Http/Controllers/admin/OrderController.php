<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\OrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('check_permission:show_orders')->only([ 'show', 'index','filter', 'exportCSV', 'search']);
        $this->middleware('check_permission:update_orders')->only(['edit', 'update','searchProducts']);
        $this->middleware('check_permission:delete_orders')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */public function index()
    {
    $orders = Order::with(['user', 'orderItems.product'])->paginate(10);
    return view('admin.orders.index', compact('orders'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load('user', 'orderItems', 'transactions');
        return view('admin.orders.form', compact('order'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order=Order::findOrFail($id);
    $products = Product::all();
    $orderItems = $order->orderItems()->with('product')->get();
    return view('admin.orders.form', compact('order', 'products', 'orderItems'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order)
    {
        $validated = $request->validated();
        $order->update($validated);
        $order->orderItems()->delete();
        if (isset($validated['products']) && is_array($validated['products'])) {
        foreach ($validated['products'] as $productData) {
            $product = Product::find($productData['id']);
            $price = $product->price_after_offer ?? $product->price_before_offer;

            $order->orderItems()->create([
                'product_id' => $productData['id'],
                'quantity' => $productData['quantity'],
                'price' => $price,
            ]);
        }
    }

        return response()->json(['status_code' => 200, 'message' => __('Order updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        $order->orderItems()->delete();
        return response()->json(['status_code' => 200, 'message' => __('order deleted successfully')]);
    }
    public function searchProducts(Request $request)
{
    $query = $request->input('query');
    $products = Product::where('name_ar', 'LIKE', "%{$query}%")->orwhere('name_en', 'LIKE', "%{$query}%")->get();

    return response()->json($products->map(function ($product) {
        return [
            'id' => $product->id,
            'name' => $product->name_ar,
            'price_after_offer' => $product->price_after_offer,
            'price_before_offer' => $product->price_before_offer,
            'image_url' => $product->getImgPath('main_image'),
        ];
    }));
}
public function search(Request $request)
{
    $orders = Order::with(['user', 'orderItems']);

    if ($request->keyword != '') {
        $orders = $orders->where(function($query) use ($request) {
            $query->where('price', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('total_price', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('payment_method', 'LIKE', '%' . $request->keyword . '%')
                ->orWhereHas('user', function($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->keyword . '%');
                })->orWhereHas('orderItems', function($q) use ($request) {
                    $q->where('quantity', 'LIKE', '%' . $request->keyword . '%');
                });
        });
    }

    $orders = $orders->paginate(20);

    foreach ($orders as $order) {
        $order->user_image_path = $order->user ? $order->user->image : null;
    }

    return response()->json([
        'orders' => $orders,
        'links' => (string) $orders->links('admin.partials.paginate')
    ]);
}

public function filter(Request $request)
{
    $rules = [
        'status' => 'nullable|in:approved,pending,done,cancelled',
        'price_filter' => 'nullable|in:equal,greater,less',
        'price_value' => 'nullable|numeric|min:0',
        'created_at' => 'nullable|date',
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $query = Order::query();

    if ($request->filled('status')) {
        $query->where('status', $request->input('status'));
    }

    if ($request->filled('price_value')) {
        $priceFilter = $request->input('price_filter');
        $priceValue = $request->input('price_value');
        if ($priceFilter && $priceValue !== null) {
            $priceValue = (float) $priceValue;

            switch ($priceFilter) {
                case 'equal':
                    $query->where('total_price', '=', $priceValue);
                    break;
                case 'greater':
                    $query->where('total_price', '>=', $priceValue);
                    break;
                case 'less':
                    $query->where('total_price', '<=', $priceValue);
                    break;
            }
        }
    }

    if ($request->filled('created_at')) {
       $query->whereDate('created_at', $request->input('created_at'));
    }

    $orders = $query->paginate(20);

    return view('admin.orders.index', compact('orders'));
}


public function exportCSV()
{
    $filename = 'orders-data.csv';

    $headers = [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
        'Pragma' => 'no-cache',
        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        'Expires' => '0',
    ];

    return response()->stream(function () {
        $handle = fopen('php://output', 'w');

        fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

        fputcsv($handle, [
            'order_number', 'status', 'total_price', 'date','user','products'
        ]);

        Order::chunk(25, function ($orders) use ($handle) {
            foreach ($orders as $order) {
                $data = [
                    $order->id,
                    $order->status,
                    $order->total_price,
                    $order->created_at,
                    $order->user->name,
                    collect($order->orderItems)->pluck('product.name_ar')->implode(', ')
                ];
                fputcsv($handle, $data);
            }
        });

        fclose($handle);
    }, 200, $headers);
}


}
