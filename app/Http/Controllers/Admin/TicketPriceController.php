<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\TypeRoom;
use App\Models\TypeSeat;
use Illuminate\Http\Request;

class TicketPriceController extends Controller
{
    public function index(Request $request)
    {

        $typeRooms = TypeRoom::all();
        $typeSeats = TypeSeat::all();

        $branches = Branch::where('is_active', '1')->get();

        // lỌc
        $cinemasPaginate = Cinema::where('is_active', '1')
            ->latest('branch_id')
            ->when($request->branch_id, function ($query) use ($request) {
                return $query->where('branch_id', $request->branch_id);
            })
            ->get();
        // ->appends($request->all());

        return view('admin.ticket-price', compact('typeRooms', 'typeSeats', 'cinemasPaginate', 'branches'));
    }

    public function update(Request $request)
    {

        if ($request->has('prices')) {

            foreach ($request->prices as $id => $price) {
                $typeSeat = TypeSeat::find($id);
                if ($typeSeat) {
                    $typeSeat->price = $price;
                    $typeSeat->save();
                }
            }
        }

        if ($request->has('surcharges')) {

            foreach ($request->surcharges as $id => $surcharge) {
                $typeRoom = TypeRoom::find($id);
                if ($typeRoom) {
                    $typeRoom->surcharge = $surcharge;
                    $typeRoom->save();
                }
            }
        }

        if ($request->has('surchargesCinema')) {

            foreach ($request->surchargesCinema as $id => $surcharge) {
                $cinema = Cinema::find($id);
                if ($cinema) {
                    $cinema->surcharge = $surcharge;
                    $cinema->save();
                }
            }
        }

        return redirect()->route('admin.ticket-price')->with('success', 'Cập nhật giá vé thành công!');
    }
}
