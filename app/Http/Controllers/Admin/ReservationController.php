<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReservationDataTable;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    function index(ReservationDataTable $dataTable)
    {
        return $dataTable->render('admin.reservation.index');
    }

    function update(Request $request) {
        $reservation = Reservation::findOrFail($request->id);
        $reservation->status = $request->status;
        $reservation->save();
        return response(['status' => 'success', 'message' => 'updated successfully!']);
    }

    function destroy(string $id)  {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
}
