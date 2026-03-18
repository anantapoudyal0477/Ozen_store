<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class Admin_SalesController extends Controller
{
    /**
     * Main sales report page
     */
    public function index()
    {
         // Initial load: latest 10 orders
    $orders = Order::with('orderItems.product', 'orderDetail', 'user')
        ->where('status', '!=', 'canceled')
        ->latest()
        ->paginate(10);

    return $this->renderAdminViewPage('administrator.sales.index', 'Sales Report', [    
        'orders' => $orders
    ]);
    }

    /**
     * Filter orders by start and end date (AJAX)
     */
    public function filterByDate(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $ordersQuery = Order::where('status', '!=', 'canceled');

        if ($startDate) $ordersQuery->whereDate('created_at', '>=', $startDate);
        if ($endDate) $ordersQuery->whereDate('created_at', '<=', $endDate);

        $orders = $ordersQuery->latest()->paginate(10);
// Debug
// dd($startDate, $endDate, $orders);
        return response()->json([
            'message' => "Showing orders from {$startDate} to {$endDate}",
            'html' => view("Administrator.Components.Sales.table.index", compact('orders'))->render(),
        ]);
    }

    /**
     * Search orders by order number or customer name (AJAX)
     */
    public function searchOrders(Request $request)
    {
        $query = $request->input('query');

        $orders = Order::with('orderItems.product', 'orderDetail', 'user')
            ->where('status', '!=', 'canceled')
            ->where(function($q) use ($query) {
                $q->where('order_number', 'like', "%{$query}%")
                  ->orWhereHas('orderDetail', function($q2) use ($query) {
                      $q2->where('full_name', 'like', "%{$query}%");
                  });
            })
            ->latest()
            ->paginate(10);
// dd($orders);
        return response()->json([
            'message' => "Search results for '{$query}'",
            'html' => view('administrator.components.sales.table', compact('orders'))->render(),
        ]);
    }

    /**
     * Pagination for orders (AJAX)
     */
    public function paginateOrders(Request $request)
    {
        $ordersQuery = Order::with('orderItems.product', 'orderDetail', 'user')
            ->where('status', '!=', 'canceled');

        $orders = $ordersQuery->latest()->paginate(10);

        return view('administrator.components.sales.table', compact('orders'))->render();
    }
}
