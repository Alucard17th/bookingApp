<?php

namespace App\Http\Controllers;

use App\Models\TimeOff;
use Illuminate\Http\Request;

class TimeOffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $timeOff = new TimeOff;
        $timeOff->name = $request->name;
        $timeOff->start_date = $request->start_date;
        $timeOff->end_date = $request->end_date;
        $timeOff->start_time = $request->start_time;
        $timeOff->end_time = $request->end_time;
        $timeOff->user_id = auth()->user()->id;
        $timeOff->save();

        return redirect()->back()->with('success', 'Time off created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TimeOff $timeOff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TimeOff $timeOff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $timeOff = TimeOff::find($id);
        $timeOff->name = $request->name;
        $timeOff->start_date = $request->start_date;
        $timeOff->end_date = $request->end_date;
        $timeOff->start_time = $request->start_time;
        $timeOff->end_time = $request->end_time;
        $timeOff->save();

        return redirect()->back()->with('success', 'Time off updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $timeOff = TimeOff::find($id);
        $timeOff->delete();
        return redirect()->back()->with('success', 'Time off deleted successfully.');
    }
}
