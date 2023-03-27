<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventApiController extends Controller
{
     public function getAllEvents()
    {
        $events = DB::table('events')->get();
        return response()->json($events);
    }

    public function getEventsByAddress(String $address) {
    	$events = DB::table('events')->where('address', $address)
                ->get();
        return response()->json($events);
    }

    public function filterEventsByAddressDate(String $address, String $startDate, String $endDate) {
    	$events = DB::table('events')->where('address', $address)->where('start_date', $startDate)->where('end_date', $endDate)
                ->get();
        return response()->json($events);
    }

}
