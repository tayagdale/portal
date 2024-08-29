<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\OrderSlip;
use App\Models\OrderSlipDetail;
use App\Models\Reservation;
use App\Models\ReservationDetails;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{

    public function index()
    {
        return view('pages/reservation/reservation_list');
    }

    public function reservation_lists()
    {
        $reservation = DB::table("reservation")
            ->select(
                "reservation.*",
                DB::raw("(SELECT description FROM customers WHERE id = reservation.customer_id) as customer")
            )->where('reservation.status', '!=', 2)
            ->get();
        return response()->json(['success' => true, 'data' => $reservation]);
    }


    /**
     * Display a listing of the resource.
     */
    public function view_reservation_detail(string $id)
    {
        $reservationDetails = DB::table("reservation_details")
            ->select('*')
            ->leftJoin("items", "reservation_details.item_id", "=", "items.id")
            ->where('reservation_details.reservation_id', $id)
            ->get();

        // dd($reservationDetails);
        return response()->json(['success' => true, 'data' => $reservationDetails]);
    }



    public function add()
    {

        $input['status'] = 2;

        $reservation = Reservation::create($input);
        $id = $reservation->id;

        return redirect()->route('reservation.show', ['id' => $id]);
    }

    public function show($id)
    {
        $customers = Customer::where([
            ['status', '=', '1'],
        ])->orderBy('description', 'DESC')->get();

        $reservation_id = $id;


        return view('pages/reservation/add_reservation')->with(compact('customers', 'reservation_id'));
    }

    public function update_page(string $id)
    {
        $customers = Customer::where([
            ['status', '=', '1'],
        ])->orderBy('description', 'DESC')->get();

        $reservation_id = $id;

        $reservation = Reservation::where([
            ['id', '=', $id],
        ])->get();

        $customer_id = $reservation[0]->customer_id;

        return view('pages/reservation/update_reservation')->with('id', $id)->with(compact('customers', 'reservation_id', 'customer_id'));
    }

    public function view_reservation_item($id)
    {
        $reservation_items = DB::table("reservation_details")
            ->select(array('*', 'reservation_details.id as id'))
            ->leftJoin("items", "reservation_details.item_id", "=", "items.id")
            ->leftJoin("units", "reservation_details.unit_id", "=", "units.id")
            ->where("reservation_details.reservation_id", $id)
            ->get();

        return response()->json(['success' => true, 'data' => $reservation_items]);
    }



    public function add_item(Request $request, $id)
    {
        $input = $request->all();
        $input['reservation_id'] = $id;

        $reservationOrderDetails = ReservationDetails::create($input);

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $reservation = Reservation::where('id', $id)->first();

        if (!$reservation) {
            return response()->json(['error' => 'Order slip not found.'], 404);
        }

        $reservation->customer_id = $request->input('customer_id');
        $reservation->reservation_date = $request->input('date');
        $reservation->status = 1;

        $reservation->save();

        return response()->json(['message' => 'Order slip updated successfully.']);
    }

    public function add_to_os(Request $request)
    {

        $os_number =  $request->input('os_number');
        $id =  $request->input('res_id');


        $reservation = Reservation::where('id', $id)->first();

        if (!$reservation) {
            return response()->json(['error' => 'Order slip not found.'], 404);
        }
        $reservation->os_number = $os_number;
        $reservation->status = 0;
        $reservation->save();

        $customer_id = $reservation->customer_id;

        $order_slips = new OrderSlip();
        $order_slips->os_number = $os_number;
        $order_slips->customer_id = $customer_id;
        $order_slips->encoded_by = auth()->user()->id;
        $order_slips->status = 4;
        $order_slips->save();

        if ($order_slips) {
            $order_slip_id = $order_slips->id;

            $reservation_details = ReservationDetails::where('reservation_id', $id)->get();

            foreach ($reservation_details as $details) {
                $item_id = $details->item_id;
                $unit_id = $details->unit_id;
                $qty = $details->qty;

                $order_slip_detail = new OrderSlipDetail();
                $order_slip_detail->os_number = $os_number;
                $order_slip_detail->item_id = $item_id;
                $order_slip_detail->unit_id = $unit_id;
                $order_slip_detail->qty = $qty;
                $order_slip_detail->save();
            }

            return redirect()->route('order_slip_add.show', ['id' => $os_number]);
        }
    }

    public function destroy_details(string $id)
    {
        $ReservationDetails = ReservationDetails::find($id);

        if (!$ReservationDetails) {
            return response()->json(['error' => 'Reservation Detail not found.'], 404);
        }

        $ReservationDetails->delete();

        return response()->json(['message' => 'Reservation Detail deleted successfully.']);
    }

    public function destroy(string $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Reservation not found.'], 404);
        }

        $reservation->delete();

        return response()->json(['message' => 'Reservation deleted successfully.']);
    }

    public function clear(string $id)
    {
        $ReservationDetails = DB::table('reservation_details')->where('reservation_id', $id);
        $ReservationDetails->delete();

        return response()->json(['message' => 'Reservation Detail has been cleared successfully.']);
    }
}
