<?php

namespace App\Http\Controllers;

use App\Classes\Utility;
use App\Models\VdsVideos;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class VdsVideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $objectsAry = VdsVideos::orderBy('title')->paginate(20);

        return view('admin.video.videos.index', compact('objectsAry') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        echo '<script>console.log("create method")</script>';
        return view( 'admin.video.videos.create' );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->title ) && $request->hasFile('filename') && $request->file('filename')->isValid() ) {

            $theobj = new VdsVideos();

            $theobj->title = $request->title;
            $theobj->description = $request->description;
            $theobj->filename = urlencode($request->file('filename')->getClientOriginalName());

            /* >>> There is couple of method you can apply while you uploading some file(s) using laravel's.
            Here is the couple of them and most important to, in my thought.*/
            //  $request->hasFile('filename')
            /* >>> hasFile method to check user upload file or not. */
            //  $request->file('filename')->isValid()
            /* >>> isValid method take care to check file have no error.
            After these checks, you have to get file properties and move to desired location. For these purposes. */
            $file = $request->file('filename');
            /* >>> Get the document information object. So after that you can use further helper function provided my laravel FileUploader. */
            //    $file->getRealPath();
            //    $file->getClientOriginalName();
            //    $file->getClientOriginalExtension();
            //    $file->getSize();
            //    $file->getMimeType();
            /* >>> and finally to move the uploaded file */
            //    $file->move($destinationPath);
            //    $file->move($destinationPath, $fileName);
            $file->move( public_path().'/videos/', urlencode( $file->getClientOriginalName() ) );

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [VdsVideosController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [VdsVideosController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Titul i/o Video inexistent' );
            $response = redirect()->action( [VdsVideosController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VdsVideos  $recursos
     * @return \Illuminate\Http\Response
     */
    public function show(VdsVideos $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VdsVideos  $recursos
     * @return \Illuminate\Http\Response
     */
    public function edit(VdsVideos $theobj)
    {

        echo '<script>console.log("edit method")</script>';
        return view('admin.video.videos.edit', compact('theobj') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VdsVideos  $recursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VdsVideos $theobj)
    {

        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->title ) && $request->hasFile('filename') ) {

            // eliminacion de archivo anterior
            //Storage::delete( public_path() . '/videos/' . urlencode( $theobj->filename ) );
            echo '<script>console.log("file: '.public_path() . '/videos/' . urlencode( $theobj->filename ).'")</script>';
            if ( file_exists( public_path() . '/videos/' . urlencode( $theobj->filename ) ) ) {
                @unlink( public_path() . '/videos/' . urlencode( $theobj->filename ) );
            }

            $theobj->title = $request->title;
            $theobj->description = $request->description;
            $theobj->filename = urlencode($request->file('filename')->getClientOriginalName());

            /* >>> There is couple of method you can apply while you uploading some file(s) using laravel's.
            Here is the couple of them and most important to, in my thought.*/
            //  $request->hasFile('filename')
            /* >>> hasFile method to check user upload file or not. */
            //  $request->file('filename')->isValid()
            /* >>> isValid method take care to check file have no error.
            After these checks, you have to get file properties and move to desired location. For these purposes. */
            $file = $request->file('filename');
            /* >>> Get the document information object. So after that you can use further helper function provided my laravel FileUploader. */
            //    $file->getRealPath();
            //    $file->getClientOriginalName();
            //    $file->getClientOriginalExtension();
            //    $file->getSize();
            //    $file->getMimeType();
            /* >>> and finally to move the uploaded file */
            //    $file->move($destinationPath);
            //    $file->move($destinationPath, $fileName);
            $file->move( public_path().'/videos/', urlencode( $file->getClientOriginalName() ) );

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [VdsVideosController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [VdsVideosController::class, 'edit'], [ 'theobj' => $theobj ] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Titul i/o Video inexistent (1)' );
            $response = redirect()->action( [VdsVideosController::class, 'edit'], [ 'theobj' => $theobj ] )->withInput();

        }

        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VdsVideos  $recursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, VdsVideos $theobj)
    {

        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [VdsVideosController::class, 'index'] );

    }
}
