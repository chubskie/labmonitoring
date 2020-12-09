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

        $start_mon = new Carbon($request->input('start'));
        $end_mon = new Carbon($request->input('end'));

        $start_tue = new Carbon($request->input('start'));
        $end_tue = new Carbon($request->input('end'));

        $start_wed = new Carbon($request->input('start'));
        $end_wed = new Carbon($request->input('end'));

        $start_th = new Carbon($request->input('start'));
        $end_th = new Carbon($request->input('end'));

        $start_fri = new Carbon($request->input('start'));
        $end_fri = new Carbon($request->input('end'));
        
        $start_sat = new Carbon($request->input('start'));
        $end_sat = new Carbon($request->input('end'));

        $start_sun = new Carbon($request->input('start'));
        $end_sun = new Carbon($request->input('end'));

        $reccuringID = Schedule::pluck('reccuringID')->last();            
        if ($request->input('recurring')  == "1") {

            for ($i = 0; $i < $range/7; $i++) {

                if($request->input('monday')  == "monday"){
                    if($i == 0){
                        $sched = new Schedule;
                        $sched->professor = $request->input('professor');
                        $sched->course = $request->input('course');
                        $sched->labID = $request->input('lab');
                        $sched->description = $request->input('description');
                        $sched->isAllDay = $request->input('isAllDay');
                        $sched->reccuring = (int) $request->input('recurring');
                        $sched->reccuringID = $reccuringID+1;
                        $sched->reccuringEnd = $reccuringEnd;
                        $sched->start = $start_mon->startOfWeek()->setTime($start->hour, $start->minute, $start->second);
                        $sched->end = $end_mon->startOfWeek()->setTime($end->hour, $end->minute, $end->second);
        
                        $sched->save();
                    }

                    $sched = new Schedule;
                    $sched->professor = $request->input('professor');
                    $sched->course = $request->input('course');
                    $sched->labID = $request->input('lab');
                    $sched->description = $request->input('description');
                    $sched->isAllDay = $request->input('isAllDay');
                    $sched->reccuring = (int) $request->input('recurring');
                    $sched->reccuringID = $reccuringID+1;
                    $sched->reccuringEnd = $reccuringEnd;
                    $sched->start = $start_mon->startOfWeek()->setTime($start->hour, $start->minute, $start->second)->addWeeks(1);
                    $sched->end = $end_mon->startOfWeek()->setTime($end->hour, $end->minute, $end->second)->addWeeks(1);
    
                    $sched->save();
                }

                if($request->input('tuesday')  == "tuesday"){
                    if($i == 0){
                        $sched = new Schedule;
                        $sched->professor = $request->input('professor');
                        $sched->course = $request->input('course');
                        $sched->labID = $request->input('lab');
                        $sched->description = $request->input('description');
                        $sched->isAllDay = $request->input('isAllDay');
                        $sched->reccuring = (int) $request->input('recurring');
                        $sched->reccuringID = $reccuringID+1;
                        $sched->reccuringEnd = $reccuringEnd;
                        $sched->start = $start_tue->startOfWeek()->setTime($start->hour, $start->minute, $start->second)->addDays(1);
                        $sched->end = $end_tue->startOfWeek()->setTime($end->hour, $end->minute, $end->second)->addDays(1);
        
                        $sched->save();
                    }
                    $sched = new Schedule;
                    $sched->professor = $request->input('professor');
                    $sched->course = $request->input('course');
                    $sched->labID = $request->input('lab');
                    $sched->description = $request->input('description');
                    $sched->isAllDay = $request->input('isAllDay');
                    $sched->reccuring = (int) $request->input('recurring');
                    $sched->reccuringID = $reccuringID+1;
                    $sched->reccuringEnd = $reccuringEnd;
                    $sched->start = $start_tue->startOfWeek()->setTime($start->hour, $start->minute, $start->second)->addDays(1)->addWeeks(1);
                    $sched->end = $end_tue->startOfWeek()->setTime($end->hour, $end->minute, $end->second)->addDays(1)->addWeeks(1);
    
                    $sched->save();
                }

                if($request->input('wednesday')  == "wednesday"){
                    if($i == 0){
                        $sched = new Schedule;
                        $sched->professor = $request->input('professor');
                        $sched->course = $request->input('course');
                        $sched->labID = $request->input('lab');
                        $sched->description = $request->input('description');
                        $sched->isAllDay = $request->input('isAllDay');
                        $sched->reccuring = (int) $request->input('recurring');
                        $sched->reccuringID = $reccuringID+1;
                        $sched->reccuringEnd = $reccuringEnd;
                        $sched->start = $start_wed->startOfWeek()->setTime($start->hour, $start->minute, $start->second)->addDays(2);
                        $sched->end = $end_wed->startOfWeek()->setTime($end->hour, $end->minute, $end->second)->addDays(2);
        
                        $sched->save();
                    }
                    $sched = new Schedule;
                    $sched->professor = $request->input('professor');
                    $sched->course = $request->input('course');
                    $sched->labID = $request->input('lab');
                    $sched->description = $request->input('description');
                    $sched->isAllDay = $request->input('isAllDay');
                    $sched->reccuring = (int) $request->input('recurring');
                    $sched->reccuringID = $reccuringID+1;
                    $sched->reccuringEnd = $reccuringEnd;
                    $sched->start = $start_wed->startOfWeek()->setTime($start->hour, $start->minute, $start->second)->addDays(2)->addWeeks(1);
                    $sched->end = $end_wed->startOfWeek()->setTime($end->hour, $end->minute, $end->second)->addDays(2)->addWeeks(1);
    
                    $sched->save();
                }

                if($request->input('thursday')  == "thursday"){
                    if($i == 0){
                        $sched = new Schedule;
                        $sched->professor = $request->input('professor');
                        $sched->course = $request->input('course');
                        $sched->labID = $request->input('lab');
                        $sched->description = $request->input('description');
                        $sched->isAllDay = $request->input('isAllDay');
                        $sched->reccuring = (int) $request->input('recurring');
                        $sched->reccuringID = $reccuringID+1;
                        $sched->reccuringEnd = $reccuringEnd;
                        $sched->start = $start_th->startOfWeek()->setTime($start->hour, $start->minute, $start->second)->addDays(3);
                        $sched->end = $end_th->startOfWeek()->setTime($end->hour, $end->minute, $end->second)->addDays(3);
        
                        $sched->save();
                    }
                    $sched = new Schedule;
                    $sched->professor = $request->input('professor');
                    $sched->course = $request->input('course');
                    $sched->labID = $request->input('lab');
                    $sched->description = $request->input('description');
                    $sched->isAllDay = $request->input('isAllDay');
                    $sched->reccuring = (int) $request->input('recurring');
                    $sched->reccuringID = $reccuringID+1;
                    $sched->reccuringEnd = $reccuringEnd;
                    $sched->start = $start_th->startOfWeek()->setTime($start->hour, $start->minute, $start->second)->addDays(3)->addWeeks(1);
                    $sched->end = $end_th->startOfWeek()->setTime($end->hour, $end->minute, $end->second)->addDays(3)->addWeeks(1);
    
                    $sched->save();
                }

                if($request->input('friday')  == "friday"){
                    if($i == 0){
                        $sched = new Schedule;
                        $sched->professor = $request->input('professor');
                        $sched->course = $request->input('course');
                        $sched->labID = $request->input('lab');
                        $sched->description = $request->input('description');
                        $sched->isAllDay = $request->input('isAllDay');
                        $sched->reccuring = (int) $request->input('recurring');
                        $sched->reccuringID = $reccuringID+1;
                        $sched->reccuringEnd = $reccuringEnd;
                        $sched->start = $start_fri->startOfWeek()->setTime($start->hour, $start->minute, $start->second)->addDays(4);
                        $sched->end = $end_fri->startOfWeek()->setTime($end->hour, $end->minute, $end->second)->addDays(4);
        
                        $sched->save();
                    }
                    $sched = new Schedule;
                    $sched->professor = $request->input('professor');
                    $sched->course = $request->input('course');
                    $sched->labID = $request->input('lab');
                    $sched->description = $request->input('description');
                    $sched->isAllDay = $request->input('isAllDay');
                    $sched->reccuring = (int) $request->input('recurring');
                    $sched->reccuringID = $reccuringID+1;
                    $sched->reccuringEnd = $reccuringEnd;
                    $sched->start = $start_fri->startOfWeek()->setTime($start->hour, $start->minute, $start->second)->addDays(4)->addWeeks(1);
                    $sched->end = $end_fri->startOfWeek()->setTime($end->hour, $end->minute, $end->second)->addDays(4)->addWeeks(1);
    
                    $sched->save();
                }

                if($request->input('saturday')  == "saturday"){
                    if($i == 0){
                        $sched = new Schedule;
                        $sched->professor = $request->input('professor');
                        $sched->course = $request->input('course');
                        $sched->labID = $request->input('lab');
                        $sched->description = $request->input('description');
                        $sched->isAllDay = $request->input('isAllDay');
                        $sched->reccuring = (int) $request->input('recurring');
                        $sched->reccuringID = $reccuringID+1;
                        $sched->reccuringEnd = $reccuringEnd;
                        $sched->start = $start_sat->startOfWeek()->setTime($start->hour, $start->minute, $start->second)->addDays(5);
                        $sched->end = $end_sat->startOfWeek()->setTime($end->hour, $end->minute, $end->second)->addDays(5);
        
                        $sched->save();
                    }
                    $sched = new Schedule;
                    $sched->professor = $request->input('professor');
                    $sched->course = $request->input('course');
                    $sched->labID = $request->input('lab');
                    $sched->description = $request->input('description');
                    $sched->isAllDay = $request->input('isAllDay');
                    $sched->reccuring = (int) $request->input('recurring');
                    $sched->reccuringID = $reccuringID+1;
                    $sched->reccuringEnd = $reccuringEnd;
                    $sched->start = $start_sat->startOfWeek()->setTime($start->hour, $start->minute, $start->second)->addDays(5)->addWeeks(1);
                    $sched->end = $end_sat->startOfWeek()->setTime($end->hour, $end->minute, $end->second)->addDays(5)->addWeeks(1);
    
                    $sched->save();
                }

                if($request->input('sunday')  == "sunday"){
                    if($i == 0){
                        $sched = new Schedule;
                        $sched->professor = $request->input('professor');
                        $sched->course = $request->input('course');
                        $sched->labID = $request->input('lab');
                        $sched->description = $request->input('description');
                        $sched->isAllDay = $request->input('isAllDay');
                        $sched->reccuring = (int) $request->input('recurring');
                        $sched->reccuringID = $reccuringID+1;
                        $sched->reccuringEnd = $reccuringEnd;
                        $sched->start = $start_sun->startOfWeek()->setTime($start->hour, $start->minute, $start->second)->addDays(6);
                        $sched->end = $end_sun->startOfWeek()->setTime($end->hour, $end->minute, $end->second)->addDays(6);
        
                        $sched->save();
                    }
                    $sched = new Schedule;
                    $sched->professor = $request->input('professor');
                    $sched->course = $request->input('course');
                    $sched->labID = $request->input('lab');
                    $sched->description = $request->input('description');
                    $sched->isAllDay = $request->input('isAllDay');
                    $sched->reccuring = (int) $request->input('recurring');
                    $sched->reccuringID = $reccuringID+1;
                    $sched->reccuringEnd = $reccuringEnd;
                    $sched->start = $start_sun->startOfWeek()->setTime($start->hour, $start->minute, $start->second)->addDays(6)->addWeeks(1);
                    $sched->end = $end_sun->startOfWeek()->setTime($end->hour, $end->minute, $end->second)->addDays(6)->addWeeks(1);
    
                    $sched->save();
                }

                }
                    
        } else {
            $sched = new Schedule;
            $sched->professor = $request->input('professor');
            $sched->course = $request->input('course');
            $sched->labID = $request->input('lab');
            $sched->description = $request->input('description');
            $sched->isAllDay = $request->input('isAllDay');
            $sched->start = $request->input('start');
            $sched->end = $request->input('end');
  
            $sched->save();
        }


          // Redirect
          return redirect('/schedules');
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
       // User::whereIn('id', $request->id)->delete();

        $sched = Schedule::where('reccuringID', $id)->delete();
        // $sched = Schedule::find($id);
        // $sched->delete();
        return response()->json('Successfully deleted!');
    }
  }
