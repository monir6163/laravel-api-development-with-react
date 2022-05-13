<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\Classes;
use DB;
use Carbon\Carbon;
use Validator;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query builder
        $class = DB::table('classes')->get();
        return response()->json($class);
        // eloquarent method 
        // return Classes::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'class_name' => 'required|unique:classes|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error'=> "Class Name Already Taken !",
            ]);
        }
        $class = [];
        $class ['class_name'] = $request->class_name;
        $class ['created_at'] = Carbon::now();
        $class ['updated_at'] = Carbon::now();
        DB::table('classes')->insert($class);
        // Classes::create($request->all());
        return response()->json([
                'success'=> 'Class Insert Successfull !!',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class_show = DB::table('classes')->where('id', $id)->first();
        if (!$class_show) {
            return response()->json([
                'error'=> "Class Name Show Problem !",
            ]);
        }
        else{
            return response()->json($class_show);
        }
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
        $validator = Validator::make($request->all(), [
          'class_name' => 'required|unique:classes|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error'=> "Class Name Already Taken !",
            ]);
        }
        $class = [];
        $class ['class_name'] = $request->class_name;
        $class ['updated_at'] = Carbon::now();
        DB::table('classes')->where('id', $id)->update($class);
        return response()->json([
            'success'=> 'Class Update Successfull !!',
        ]);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class_del = DB::table('classes')->where('id', $id)->delete();
        if (!$class_del) {
            return response()->json([
                'error'=> "Class Name Delete Problem !",
            ]);
        }
        else{
            return response()->json([
                'success'=> 'Class Delete Successfull !!',
            ]);
        }
    }
}
