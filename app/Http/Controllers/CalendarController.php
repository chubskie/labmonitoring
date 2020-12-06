<?php

namespace App\Http\Controllers;
use App\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required',
        //     'subject' => 'required',
        //     'message' => 'required'
        //   ]);

        

        $start = new Carbon($request->input('start'));
        $end = new Carbon($request->input('end'));

        $reccuringEnd = new Carbon($request->input('recurringEnd'));
   
        $date1 = new Carbon($end);
        $date2 = new Carbon($reccuringEnd);

        $range = (int)$date1->diffInDays($date2);


        if ($request->input('recurring')  == "1") {

            $sched = new Schedule;
            $sched->professor = $request->input('professor');
            $sched->course = $request->input('course');
            $sched->labID = $request->input('lab');
            $sched->isAllDay = $request->input('isAllDay');
            $sched->reccuring = (int) $request->input('reccuring');
            $sched->reccuringEnd = $reccuringEnd;
            $sched->start = $start;
            $sched->end = $end;

            $sched->save();


            for ($i = 0; $i < $range/7; $i++) {
                
                $sched = new Schedule;
                $sched->professor = $request->input('professor');
                $sched->course = $request->input('course');
                $sched->labID = $request->input('lab');
                $sched->isAllDay = $request->input('isAllDay');
                $sched->reccuring = (int) $request->input('reccuring');
                $sched->reccuringEnd = $reccuringEnd;
                $sched->start = $start->addDays(7);
                $sched->end = $end->addDays(7);

                $sched->save();
                }
                    
        } else {
            $sched = new Schedule;
            $sched->professor = $request->input('professor');
            $sched->course = $request->input('course');
            $sched->labID = $request->input('lab');
            $sched->isAllDay = $request->input('isAllDay');
            $sched->start = $request->input('start');
            $sched->end = $request->input('end');
  
            $sched->save();
        }


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
