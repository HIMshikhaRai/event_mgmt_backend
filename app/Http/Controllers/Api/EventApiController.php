<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Event;

class EventApiController extends Controller
{
     public function getAllEvents()
    {
        $events = DB::table('events')->get();
        $baseUrl = url('/');

        $newEventList = [];
        foreach ($events as $item) {
            $pictureUrl = $baseUrl . "/uploads/" . $item->event_picture;

            $event  = new Event;
            $event->name = $item->name;
            $event->description = $item->description;
            $event->address = $item->address;
            $event->start_date = $item->start_date;
            $event->end_date = $item->end_date;
            $event->event_picture = $pictureUrl;
            $event->ticket_type = $item->ticket_type;
            $event->ticket_price = $item->ticket_price;
            $newEventList[] = $event;
        }

        return response()->json($newEventList);
    }

    public function getEventsByAddress(String $address) {
    	$events = DB::table('events')->where('address', 'like', '%' . $address . '%')
                ->get();
        $baseUrl = url('/');

        $newEventList = [];
        foreach ($events as $item) {
            $pictureUrl = $baseUrl . "/uploads/" . $item->event_picture;

            $event  = new Event;
            $event->name = $item->name;
            $event->description = $item->description;
            $event->address = $item->address;
            $event->start_date = $item->start_date;
            $event->end_date = $item->end_date;
            $event->event_picture = $pictureUrl;
            $event->ticket_type = $item->ticket_type;
            $event->ticket_price = $item->ticket_price;
            $newEventList[] = $event;
        }

        return response()->json($newEventList);
    }

    public function filterEventsByAddressDate(String $address, String $startDate, String $endDate) {
    	$events = DB::table('events')->where('address', 'like', '%' . $address . '%')->where('start_date', $startDate)->where('end_date', $endDate)
                ->get();
        $baseUrl = url('/');

        $newEventList = [];
        foreach ($events as $item) {
            $pictureUrl = $baseUrl . "/uploads/" . $item->event_picture;
        
            $event  = new Event;
            $event->name = $item->name;
            $event->description = $item->description;
            $event->address = $item->address;
            $event->start_date = $item->start_date;
            $event->end_date = $item->end_date;
            $event->event_picture = $pictureUrl;
            $event->ticket_type = $item->ticket_type;
            $event->ticket_price = $item->ticket_price;
            $newEventList[] = $event;
        }
        
        return response()->json($newEventList);
    }

}
