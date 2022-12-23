<?php

namespace App\Http\Controllers;

use App\Http\Resources\VillaResource;
use App\Models\Villa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function getVillaApi()
    {
        return VillaResource::collection(Villa::latest()->get());
    }

    public function booking(Request $request)
    {

        $villa = Villa::where('id', $request->villa_id['id'])->first();

        $myDate = date('m/d/Y');
        $day = Carbon::createFromFormat('m/d/Y', $myDate)->format('l');

        $check = $villa->appintments()->whereDate('created_at', date('Y-m-d'))->exists();

       if (!$check){
           if ($day == 'Friday' || $day == 'Thursday') {
               $villa->appintments()->create([
                   'user_id' => auth()->id(),
                   'backgroundColor' => 'red',
                   'start_date' => now(),
                   'end_date' => now(),
                   'extra_price' => 10,
                   'day' => $day,
               ]);
           }else{
               $villa->appintments()->create([
                   'user_id' => auth()->id(),
                   'backgroundColor' => 'red',
                   'start_date' => now(),
                   'end_date' => now(),
                   'day' => $day,
               ]);
           }

           return response()->json([
               'message' => 'Your booking done',
           ],200);
       }else{
           return response()->json([
               'fail' => 'Sorry, this booked',
           ],200);
       }
    }
}
