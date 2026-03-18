<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Products;
use App\Models\OrderItem;
use App\Models\Appointment;
use Carbon\Carbon;

class Admin_DashboardController extends Controller
{
    /**
     * Display Admin Dashboard
     */
    public function index()
    {
        // -------------------
        // 1️⃣ Basic Counts
        // -------------------
        $totalOrders = Order::count();
        $totalCustomers = User::where('user_type', 'user')->count();
        $totalDoctors = Doctor::count();
        $totalAppointments = Appointment::count();

        // -------------------
        // 2️⃣ Revenue per month for chart
        // -------------------
        $revenueRaw = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_price) as total')
            ->groupBy('year','month')->orderBy('year')->orderBy('month')->get();

        $revenue = $revenueRaw->map(function($item) {
            return [
                'label' => Carbon::create($item->year, $item->month, 1)->format('M Y'),
                'value' => $item->total
            ];
        });

        // -------------------
        // 3️⃣ Sales per month for chart
        // -------------------
        $salesRaw = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year','month')->orderBy('year')->orderBy('month')->get();

        $sales = $salesRaw->map(function($item) {
            return [
                'label' => Carbon::create($item->year, $item->month, 1)->format('M Y'),
                'value' => $item->count
            ];
        });

        // -------------------
        // 4️⃣ Most Purchased Product
        // -------------------
        $mostPurchased = OrderItem::selectRaw('product_id, SUM(quantity) as qty')
            ->groupBy('product_id')
            ->orderByDesc('qty')
            ->first();

        $mostPurchasedProduct = $mostPurchased ? Products::find($mostPurchased->product_id) : null;

        // -------------------
        // 5️⃣ Upcoming Appointments (next 2 hours)
        // -------------------
        $upcomingAppointments = Appointment::whereBetween('appointment_time', [
            Carbon::now(),
            Carbon::now()->addHours(2)
        ])->orderBy('appointment_time')->get();

        // -------------------
        // 6️⃣ Prescription vs Normal Orders for chart
        // -------------------
        $prescriptionData = [
            ['label' => 'Prescription', 'value' => OrderItem::where('isPrescription',1)->count(), 'color' => '#6366F1'],
            ['label' => 'Normal', 'value' => OrderItem::where('isPrescription',0)->count(), 'color' => '#A855F7'],
        ];

        // -------------------
        // Render Admin Dashboard
        // -------------------
        return $this->renderAdminViewPage(
            'Administrator.dashboard.index',
            'Admin Dashboard',
            [
                'totalOrders' => $totalOrders,
                'totalCustomers' => $totalCustomers,
                'totalDoctors' => $totalDoctors,
                'totalAppointments' => $totalAppointments,
                'revenue' => $revenue,
                'sales' => $sales,
                'mostPurchased' => $mostPurchased,
                'mostPurchasedProduct' => $mostPurchasedProduct,
                'upcomingAppointments' => $upcomingAppointments,
                'prescriptionData' => $prescriptionData
            ]
        );
    }

    /**
     * AJAX: Dashboard data for charts
     */
    public function ajaxDashboardData(Request $request)
    {
        $range = $request->query('range', 'month'); // optional filter

        // Total counts
        $totalOrders = Order::count();
        $totalCustomers = User::where('user_type','customer')->count();
        $totalDoctors = Doctor::count();
        $totalAppointments = Appointment::count();

        // Revenue
        $revenueRaw = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_price) as total')
            ->groupBy('year','month')->orderBy('year')->orderBy('month')->get();
        $revenue = $revenueRaw->map(function($item) {
            return [
                'label' => Carbon::create($item->year, $item->month, 1)->format('M Y'),
                'value' => $item->total
            ];
        });

        // Sales
        $salesRaw = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year','month')->orderBy('year')->orderBy('month')->get();
        $sales = $salesRaw->map(function($item) {
            return [
                'label' => Carbon::create($item->year, $item->month, 1)->format('M Y'),
                'value' => $item->count
            ];
        });

        // Top 5 products
        $topProducts = OrderItem::selectRaw('product_id, SUM(quantity) as qty')
            ->groupBy('product_id')
            ->orderByDesc('qty')
            ->take(5)
            ->get()
            ->map(function($item) {
                $product = Products::find($item->product_id);
                return [
                    'name' => $product ? $product->product_name : 'Unknown',
                    'qty' => $item->qty,
                ];
            });

        // Prescription vs Normal
        $prescriptionData = [
            ['label' => 'Prescription', 'value' => OrderItem::where('isPrescription',1)->count(), 'color' => '#6366F1'],
            ['label' => 'Normal', 'value' => OrderItem::where('isPrescription',0)->count(), 'color' => '#A855F7'],
        ];

        return response()->json([
            'totalOrders'=>$totalOrders,
            'totalCustomers'=>$totalCustomers,
            'totalDoctors'=>$totalDoctors,
            'totalAppointments'=>$totalAppointments,
            'revenue'=>$revenue,
            'sales'=>$sales,
            'topProducts'=>$topProducts,
            'prescriptionStats'=>$prescriptionData,
        ]);
    }
}
