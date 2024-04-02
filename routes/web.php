<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Example Routes
// Route::match(['get', 'post'], 'admin/dashboard', function () {
//     return view('dashboard');
// });
// Route::match(['get', 'post'], 'admin/login', function () {
//     return view('login');
// });
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');


//Auth Routes

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('dashboard.index');

    Route::group(['middleware' => ['guest']], function () {

        /**
         * Login Routes
         */
        Route::view('/', 'login');
        Route::get('admin/login', 'LoginController@show')->name('login.show');
        Route::post('admin/login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function () {

        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        Route::view('/admin/dashboard', 'dashboard');

        //Purchasing Routes
        Route::view('/admin/purchase_order', 'pages/purchasing/purchase_order');
        Route::view('/admin/print_purchase_order', 'pages/purchasing/print_purchase_order');
        Route::view('/admin/inspection', 'pages/purchasing/inspection');
        Route::view('/admin/inventory', 'pages/purchasing/inventory');

        //Purchase Order Routes
        Route::get('admin/purchase_orders/all', 'PurchaseOrderController@index')->name('purchase_order_add.all');
        Route::get('admin/purchase_orders/active/all', 'PurchaseOrderController@get_all_active_purchase_orders')->name('purchase_order_add.active.all');
        Route::get('admin/purchase_orders/create', 'PurchaseOrderController@createDraft')->name('purchase_order_add.create');
        Route::get('admin/purchase_orders/create/{id}', 'PurchaseOrderController@show')->name('purchase_order_add.show');
        Route::put('/admin/purchase_orders/{id}', 'PurchaseOrderController@update')->name('purchase_order.update');
        Route::get('admin/purchase_orders/print/{po_number}', 'PurchaseOrderController@print')->name('purchase_order.print');
        Route::get('admin/purchase_orders/print_/{po_number}', 'PurchaseOrderController@print_without_inspection')->name('purchase_order.print_without_inspection');

        //Purchase Order Details Routes
        Route::get('admin/purchase_order_details/{id}', 'PurchaseOrderDetailController@index')->name('purchase_order_details.all');
        Route::get('admin/purchase_order_details/total/{id}', 'PurchaseOrderDetailController@get_total_amount')->name('purchase_order_details.total');
        Route::post('admin/purchase_order_details', 'PurchaseOrderDetailController@store')->name('purchase_order_details.store');
        Route::put('admin/purchase_order_details/update/{id}', 'PurchaseOrderDetailController@update')->name('purchase_order_details.update');
        Route::delete('admin/purchase_order_details/{id}', 'PurchaseOrderDetailController@destroy')->name('purchase_order_details.remove');
        Route::delete('admin/purchase_order_details/clear/{id}', 'PurchaseOrderDetailController@clear')->name('purchase_order_details.clear');

        //Inspection Routes
        Route::get('admin/inspections/all', 'InspectionController@index')->name('inspection.all');
        Route::get('admin/inspections/active/all', 'InspectionController@get_all_active_inspections')->name('inspection.active.all');
        Route::post('admin/inspections/{id}', 'InspectionController@store')->name('inspection.store');
        Route::get('admin/inspections/{inspection_number}/{po_number}', 'InspectionController@show')->name('inspection.show');

        //Inspection Details Routes
        Route::get('admin/inspection_details/{id}', 'InspectionDetailController@index')->name('inspection_details.all');
        Route::post('admin/inspection_details/create', 'InspectionDetailController@store')->name('inspection_details.store');

        //Inventory Routes
        Route::get('admin/inventory/all', 'InventoryController@index')->name('inventory.all');
        Route::get('admin/inventory/uom/{id}', 'InventoryController@get_uom')->name('inventory.get_uom');

        //Inventory Details Routes
        Route::get('admin/inventory_details/data/{id}', 'InventoryDetailController@get_inventory_by_order_slip')->name('inventory_details.os');
        Route::get('admin/inventory_details/data/item/{id}', 'InventoryDetailController@get_inventory_by_item_id')->name('inventory_details.get_by_item_id');

        //Sales Routes
        Route::view('/admin/order_slip', 'pages/sales/order_slip')->name('order_slip_main.show');
        Route::view('/admin/sales_order', 'pages/sales/sales_order');
        Route::view('/admin/delivery', 'pages/sales/delivery');
        Route::view('/admin/sales_invoice', 'pages/sales/sales_invoice');


        //Order Slip Routes
        Route::get('admin/order_slips/all', 'OrderSlipController@index')->name('order_slip_add.all');
        Route::get('admin/order_slips/active/all', 'OrderSlipController@get_all_active_order_slips')->name('order_slip_add.active.all');
        Route::get('admin/order_slips/create', 'OrderSlipController@createDraft')->name('order_slip_add.create');
        Route::get('admin/order_slips/create/{id}', 'OrderSlipController@show')->name('order_slip_add.show');
        Route::put('/admin/order_slips/{id}', 'OrderSlipController@update')->name('order_slip.update');

        //Order Slip Details Routes
        Route::get('admin/order_slip_details/{id}', 'OrderSlipDetailController@index')->name('order_slip_details.all');
        Route::post('admin/order_slip_details', 'OrderSlipDetailController@store')->name('order_slip_details.store');
        Route::put('admin/order_slip_details/update/{id}', 'OrderSlipDetailController@update')->name('order_slip_details.update');
        Route::delete('admin/order_slip_details/{id}', 'OrderSlipDetailController@destroy')->name('order_slip_details.remove');
        Route::delete('admin/order_slip_details/clear/{id}', 'OrderSlipDetailController@clear')->name('order_slip_details.clear');
        Route::get('admin/order_slip_details/total_qty/{id}', 'OrderSlipDetailController@get_total_qty')->name('order_slip_details.total_qty');



        //Sales Order Routes
        Route::get('admin/sales_orders/all', 'SalesOrderController@index')->name('sales_order.all');
        Route::get('admin/sales_orders/active/all', 'SalesOrderController@get_all_active_sales_orders')->name('sales_order.active.all');
        Route::post('admin/sales_orders/{id}', 'SalesOrderController@store')->name('sales_order.store');
        Route::get('admin/sales_orders/update/{so_number}', 'SalesOrderController@show')->name('sales_order.show');
        Route::get('admin/sales_orders/print/{so_number}', 'SalesOrderController@print')->name('sales_order.print');

        //Sales Order Details Routes
        Route::get('admin/sales_order_details/{id}', 'SalesOrderDetailController@index')->name('sales_order_details.all');
        Route::post('admin/sales_order_details', 'SalesOrderDetailController@store')->name('sales_order_details.store');
        Route::delete('admin/sales_order_details/{id}', 'SalesOrderDetailController@destroy')->name('sales_order_details.remove');


        //Delivery Routes
        Route::get('admin/delivery/all', 'DeliveryController@index')->name('delivery.all');
        Route::post('admin/delivery/{id}', 'DeliveryController@store')->name('delivery.store');
        Route::get('admin/delivery/active/all', 'DeliveryController@get_all_active_deliveries')->name('delivery.active.all');
        Route::get('admin/delivery/print/{dr_number}', 'DeliveryController@print')->name('delivery.print');

        //Delivery Details Routes
        Route::get('admin/delivery_details/{id}', 'DeliveryDetailController@index')->name('delivery_details.all');


        //Sales Invoice Routes
        Route::get('admin/sales_invoice/all', 'SalesInvoiceController@index')->name('sales_invoice.all');
        Route::post('admin/sales_invoice/{id}', 'SalesInvoiceController@store')->name('sales_invoice.store');
        Route::get('admin/sales_invoice/active/all', 'SalesInvoiceController@get_all_active_sales_invoices')->name('sales_invoice.active.all');
        Route::get('admin/sales_invoice/print/{si_number}', 'SalesInvoiceController@print')->name('sales_invoice.print');

        //Sales Invoice Details Routes
        Route::get('admin/sales_invoice_details/{id}', 'SalesInvoiceDetailController@index')->name('sales_invoice_details.all');

        //Incoming Payment Routes
        Route::get('admin/incoming_payment/all', 'IncomingPaymentController@index')->name('incoming_payment.all');
        Route::post('admin/incoming_payment/{id}', 'IncomingPaymentController@store')->name('incoming_payment.store');

        //Outgoing Payment Routes
        Route::get('admin/outgoing_payment/all', 'OutgoingPaymentController@index')->name('outgoing_payment.all');
        Route::post('admin/outgoing_payment/{id}', 'OutgoingPaymentController@store')->name('outgoing_payment.store');

        //Accounting Routes
        Route::view('/admin/incoming_payment', 'pages/payment/incoming_payment');
        Route::view('/admin/outgoing_payment', 'pages/payment/outgoing_payment');

        //File Maintenance Routes
        Route::view('/admin/categories', 'pages/file_maintenance/categories');
        Route::view('/admin/terms', 'pages/file_maintenance/terms');
        Route::view('/admin/sub_categories', 'pages/file_maintenance/sub_categories');
        Route::view('/admin/items', 'pages/file_maintenance/items');
        Route::view('/admin/units', 'pages/file_maintenance/units');
        Route::view('/admin/customers', 'pages/file_maintenance/customers');
        Route::view('/admin/suppliers', 'pages/file_maintenance/suppliers');
        Route::view('/admin/users', 'pages/file_maintenance/users');
        Route::view('/admin/warehouse', 'pages/file_maintenance/warehouse');
        Route::view('/admin/inventory_status', 'pages/file_maintenance/inventory_status');
        Route::view('/admin/roles', 'pages/file_maintenance/roles');
        Route::view('/admin/permissions', 'pages/file_maintenance/permissions');
        Route::view('/admin/tax', 'pages/file_maintenance/tax');

        //User Routes
        Route::get('/admin/users/all', 'UserController@index');
        Route::put('/admin/users/{id}', 'UserController@update')->name('users.update');


        //Supplier Routes
        Route::get('/admin/suppliers/all', 'SupplierController@index');
        Route::post('/admin/suppliers', 'SupplierController@store')->name('suppliers.store');
        Route::put('/admin/suppliers/{id}', 'SupplierController@update')->name('suppliers.update');
        Route::delete('/admin/suppliers/{id}', 'SupplierController@destroy')->name('suppliers.remove');

        //Customer Routes
        Route::get('/admin/customers/all', 'CustomerController@index');
        Route::post('/admin/customers', 'CustomerController@store')->name('customers.store');
        Route::put('/admin/customers/{id}', 'CustomerController@update')->name('customers.update');
        Route::delete('/admin/customers/{id}', 'CustomerController@destroy')->name('customers.remove');

        //Unit Routes
        Route::get('/admin/units/all', 'UnitController@index');
        Route::post('/admin/units', 'UnitController@store')->name('units.store');
        Route::put('/admin/units/{id}', 'UnitController@update')->name('units.update');
        Route::delete('/admin/units/{id}', 'UnitController@destroy')->name('units.remove');

        //Item Routes
        Route::get('/admin/items/all', 'ItemController@index');
        Route::post('/admin/items', 'ItemController@store')->name('items.store');
        Route::put('/admin/items/{id}', 'ItemController@update')->name('items.update');
        Route::put('/admin/items/{id}/conversion', 'ItemController@conversion')->name('items.conversion');
        Route::delete('/admin/items/{id}', 'ItemController@destroy')->name('items.remove');


        //Category Routes
        Route::get('/admin/categories/all', 'CategoryController@index');
        Route::post('/admin/categories', 'CategoryController@store')->name('categories.store');
        Route::put('/admin/categories/{id}', 'CategoryController@update')->name('categories.update');
        Route::delete('/admin/categories/{id}', 'CategoryController@destroy')->name('categories.remove');

        //Terms Routes
        Route::get('/admin/terms/all', 'TermsController@index');
        Route::post('/admin/terms', 'TermsController@store')->name('terms.store');
        Route::put('/admin/terms/{id}', 'TermsController@update')->name('terms.update');
        Route::delete('/admin/terms/{id}', 'TermsController@destroy')->name('terms.remove');

        //Ca;endar Routes
        Route::get('/admin/calendars/all', 'CalendarController@index');
        //Warehouse Routes
        Route::get('/admin/warehouse/all', 'WarehouseController@index');
        Route::post('/admin/warehouse', 'WarehouseController@store')->name('warehouse.store');
        Route::put('/admin/warehouse/{id}', 'WarehouseController@update')->name('warehouse.update');
        Route::delete('/admin/warehouse/{id}', 'WarehouseController@destroy')->name('warehouse.remove');

        //Inventory Status Routes
        Route::get('/admin/inventory_status/all', 'InventoryStatusController@index');
        Route::put('/admin/inventory_status/{id}', 'InventoryStatusController@update')->name('inventory_status.update');

        //Permissions Routes
        Route::get('/admin/permissions/all', 'PermissionsController@index');
        Route::get('/admin/permissions/unassigned/{id}', 'PermissionsController@get_unassigned');
        Route::get('/admin/permissions/get_current/{id}', 'PermissionsController@get_current');
        Route::post('/admin/permissions', 'PermissionsController@store')->name('permissions.store');
        Route::put('/admin/permissions/{id}', 'PermissionsController@update')->name('permissions.update');
        Route::delete('/admin/permissions/{id}', 'PermissionsController@destroy')->name('permissions.remove');
        Route::post('/admin/permissions_to_roles', 'PermissionsController@assign_permission');
        Route::delete('/admin/permissions_to_roles/{id}', 'PermissionsController@unassign_permission');

        //Roles Routes
        Route::get('/admin/roles/all', 'RolesController@index');
        Route::post('/admin/roles', 'RolesController@store')->name('roles.store');
        Route::put('/admin/roles/{id}', 'RolesController@update')->name('roles.update');
        Route::delete('/admin/roles/{id}', 'RolesController@destroy')->name('roles.remove');
        Route::get('admin/roles/assign/{role_id}', 'RolesController@assign')->name('roles.assign');


        //Taxes Routes
        Route::get('/admin/taxes/all', 'TaxController@index');
        Route::put('/admin/taxes/{id}', 'TaxController@update')->name('tax.update');

        //Reservation Routes
        Route::get('/admin/reservation', 'ReservationController@index');
        Route::get('/admin/reservation/all', 'ReservationController@reservation_lists')->name('reservation.reservation_lists');
        Route::get('/admin/reservation/add', 'ReservationController@add')->name('reservation.add');
        Route::get('/admin/reservation/{id}', 'ReservationController@show')->name('reservation.show');
        Route::post('/admin/reservation/{id}', 'ReservationController@add_item')->name('reservation.add_item');
        Route::get('/admin/reservation/details/{id}', 'ReservationController@view_reservation_item')->name('reservation.view_reservation_item');
        Route::put('/admin/reservation/{id}', 'ReservationController@update')->name('ReservationController.update');
        Route::delete('/admin/reservation/{id}', 'ReservationController@destroy')->name('ReservationController.remove');
        Route::delete('/admin/reservation/details/{id}', 'ReservationController@destroy_details')->name('ReservationController.destroy_details');
        Route::delete('/admin/reservation/clear/{id}', 'ReservationController@clear')->name('ReservationController.clear');
        Route::get('/admin/reservation/update/{id}', 'ReservationController@update_page')->name('reservation.update_page');
        Route::post('/admin/reservation/add/os', 'ReservationController@add_to_os')->name('reservation.add_to_os');

    });
});
