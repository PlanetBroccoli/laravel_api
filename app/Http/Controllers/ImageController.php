<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Storage;
use carbon\carbon;
use Illuminate\Contracts\Filesystem\Filesystem;
use DB;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return \GuzzleHttp\json_encode(Image::all());
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

        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $file = $image->getClientOriginalName();

            $filename = carbon::now()->format('YmdHis'). "_" . $file;


            if(Storage::disk('s3')->put($filename, file_get_contents($image), 'public')){
                $image = array(
                    'userId' => $request->userId,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'url' => $filename,
                    'created_at' => Carbon::now()
                );

                return \GuzzleHttp\json_encode($result =  DB::table('images')->insert($image));
//
            }
            else{
                return \GuzzleHttp\json_encode("error");
            }
        }
//
//        {
//            "status": "success",
//  "data": {
//            /* Application-specific data would go here. */
//        },
//  "message": null /* Or optional success message */
//}
//
//        {
//            "status": "error",
//  "data": null, /* or optional error payload */
//  "message": "Error xyz has occurred"
//}


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }

    public function testS3()
    {
        $filename = carbon::now()->format('YmdHis'). "_". "test.txt";
        Storage::disk('s3')->put($filename, 'World', 'public');
        $url = Storage::disk('s3')->url($filename);

        return \GuzzleHttp\json_encode($url);
    }
}
