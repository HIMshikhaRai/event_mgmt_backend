<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('id','desc')->paginate(5);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'event_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ticket_type' => 'required',
            'ticket_price' => 'required',
        ]);

        $pictureName = time().'.'.$request->event_picture->extension();  
        $request->event_picture->move(public_path('uploads'), $pictureName);

        $event = new Event;
        $event->name = $request->name;
        $event->description = $request->description;
        $event->address = $request->address;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->event_picture = $pictureName;
        $event->ticket_type = $request->ticket_type;
        $event->ticket_price = $request->ticket_price;
        $event->save();

        return redirect()->route('events.index')->with('success','Event has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit',compact('event'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'event_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ticket_type' => 'required',
            'ticket_price' => 'required',
        ]);
        
        $pictureName = time().'.'.$request->event_picture->extension();  
        $request->event_picture->move(public_path('uploads'), $pictureName);

        $events = Event::where('id', $id)->get();
        $event = $events->first();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->address = $request->address;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->event_picture = $pictureName;
        $event->ticket_type = $request->ticket_type;
        $event->ticket_price = $request->ticket_price;
        $event->save();

        return redirect()->route('events.index')->with('success','Event has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success','Event has been deleted successfully');
    }
}
