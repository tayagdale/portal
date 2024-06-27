<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('dashboard');
        }
    }


    public function show_dashboard()
    {
        $reservations_count =  DB::table('reservation')
            ->count();

        $sales_orders_count =  DB::table('sales_orders')
            ->count();

        $open_purchase_orders =  DB::table('purchase_orders')
            ->where('status', 1)
            ->count();

        $closed_purchase_orders =  DB::table('purchase_orders')
            ->where('status', 2)
            ->count();

        $purchase_orders = DB::table("purchase_orders")
            ->groupBy('purchase_orders.id')
            ->orderBy('purchase_orders.created_at', 'DESC')
            ->limit(5)
            ->get();

        $reservations = DB::table("reservation")
            ->leftJoin("customers", "customers.id", "=", "reservation.customer_id")
            ->orderBy('reservation.created_at', 'DESC')
            ->limit(5)
            ->get();

        $sales_orders = DB::table("sales_orders")
            ->groupBy('sales_orders.id')
            ->orderBy('sales_orders.created_at', 'DESC')
            ->limit(5)
            ->get();

        $order_slips = DB::table("order_slips")
            ->groupBy('order_slips.id')
            ->orderBy('order_slips.created_at', 'DESC')
            ->limit(5)
            ->get();

        return view('/dashboard')->with(
            [
                'open_purchase_orders' => $open_purchase_orders,
                'closed_purchase_orders' => $closed_purchase_orders,
                'sales_orders_count' => $sales_orders_count,
                'reservations_count' => $reservations_count,
                'purchase_orders' => $purchase_orders,
                'sales_orders' => $sales_orders,
                'order_slips' => $order_slips,
                'reservations' => $reservations,
            ]
        );
    }
}
