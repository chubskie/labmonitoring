<?php

namespace App\Http\Controllers;

use App\Laboratory;
use Illuminate\Http\Request;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$labs = Laboratory::orderBy('labName', 'asc')->get();
    	return view('dashboard', [
    		'labs' => $labs
    	]);
    }


    public function laboratory(){ 
        return Laboratory::all(); 
      }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    	$duplicates = Laboratory::where('labName', $request->name)->count();

    	if ($duplicates > 0)
    		return response()->json(['status' => 'error', 'msg' => 'Lab name already exists']);
    	return response()->json(['status' => 'success']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$duplicates = Laboratory::where('labName', $request->name)->count();

    	if ($duplicates > 0)
    		return response()->json(['status' => 'error', 'msg' => 'Lab name already exists']);

    	$lab = new Laboratory;
        $lab->labName = strip_tags($request->name);
        $lab->color = strip_tags($request->color);
    	$lab->save();

    	$labs = Laboratory::orderBy('labName', 'asc')->get();
    	return redirect(route('dashboard'));
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
