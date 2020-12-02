<?php

namespace App\Http\Controllers;
use App\Schedule;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $schedules = Schedule::all();
      return view('calendar')->with('schedules', $schedules);
    }
    public function schedules(){ 
      return Schedule::all(); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // $this->validate($request, [
      //     'name' => 'required',
      //     'email' => 'required',
      //     'subject' => 'required',
      //     'message' => 'required'
      //   ]);

      $sched = new Schedule;
      $sched->professor = $request->input('professor');
      $sched->course = $request->input('course');
      $sched->isAllDay = $request->input('isAllDay');
      $sched->start = $request->input('start');
      $sched->end = $request->input('end');

      $sched->save();

      // Redirect
      return redirect('/schedules')->with('success', 'Message Sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
  }
