<?php

namespace App\Http\Controllers\API;

use App\Hdf;
use App\Http\Controllers\Controller;
use App\Http\Resources\HDFResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hdfs = Hdf::all();
        return response([ 'hdfs' => HDFResource::collection($hdfs), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'mobile_number' => 'required|max:255',
            
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $hdf = Hdf::create($data);

        return response([ 'hdf' => new HDFResource($hdf), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hdf  $hdf
     * @return \Illuminate\Http\Response
     */
    public function show(Hdf $hdf)
    {
        return response([ 'hdf' => new HDFResource($hdf), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hdf  $hdf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hdf $hdf)
    {

        $hdf->update($request->all());

        return response([ 'hdf' => new HDFResource($hdf), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Hdf $hdf
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Hdf $hdf)
    {
        $hdf->delete();

        return response(['message' => 'Deleted']);
    }
}