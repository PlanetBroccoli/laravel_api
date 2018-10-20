<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Report;
use carbon\carbon;
use Illuminate\Contracts\Filesystem\Filesystem;
use DB;;

class MarkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

    public function getNearMarker(Request $request)
    {
        $imgs = [];
        $reps = [];


        $earthRadius = 6367000;
        $target_lat = ($request->latitude * pi() ) / 180;
        $target_lng = ($request->longitude * pi() ) / 180;

        $images = Image::all();
        $reports = Report::all();
//
        for ($i = 0; $i < count($images); $i++) {
            $lat = ($images[$i]->latitude * pi()) / 180;
            $lng = ($images[$i]->longitude * pi()) / 180;

            $calcLatitude = $lat - $target_lat;
            $calcLongitude = $lng - $target_lng;
            $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat) * cos($target_lat) * pow(sin($calcLongitude / 2), 2);
            $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
            $calculatedDistance = $earthRadius * $stepTwo;

            if($calculatedDistance <= 200){
                array_push($imgs,$images[$i]);

            }

        }

        for ($i = 0; $i < count($reports); $i++) {
            $lat = ($reports[$i]->latitude * pi()) / 180;
            $lng = ($reports[$i]->longitude * pi()) / 180;

            $calcLatitude = $lat - $target_lat;
            $calcLongitude = $lng - $target_lng;
            $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat) * cos($target_lat) * pow(sin($calcLongitude / 2), 2);
            $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
            $calculatedDistance = $earthRadius * $stepTwo;

            if($calculatedDistance <= 200){
                array_push($reps,$reports[$i]);

            }

        }

        $markers = ["images"=> $imgs, "reports" => $reps];

        return \GuzzleHttp\json_encode($markers);
    }

    public function getAllMarkers()
    {
        $images = Image::select('url', 'latitude', 'longitude', 'url', 'created_at')->get();
        $reports = Report::select('latitude', 'longitude', 'created_at')->get();

        $result = ["images"=> $images, "reports" => $reports];

        return \GuzzleHttp\json_encode($result);

    }
}
