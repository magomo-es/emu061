<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Recurs;
use App\Models\Usuari;
use App\Classes\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UsuariController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // - - - - - search block =>
        $searchRol = ( $request->input('srchrol') > 0 );
        $searchName = ( strlen( $request->input('srchname') ) > 0 );
        if ( $searchRol && $searchName ) {
            echo '<script>console.log(" search by searchRol && searchName")</script>';
            $objectsAry = Usuari::where( 'rols_id','=', $request->input('srchrol') )
                ->where( 'username', 'like', '%'.$request->input('srchname').'%' )
                ->orderBy('username')
                ->paginate(10)
                ->withQueryString();
        } else if ( $searchRol && !$searchName ) {
            echo '<script>console.log(" search by searchRol")</script>';
            $objectsAry = Usuari::where( 'rols_id','=', $request->input('srchrol') )
                ->orderBy('username')
                ->paginate(10)
                ->withQueryString();
        } else if ( !$searchRol && $searchName ) {
            echo '<script>console.log(" search by searchName")</script>';
            $objectsAry = Usuari::where('username', 'like', '%'.$request->input('srchname').'%')
                ->orderBy('username')
                ->paginate(10)
                ->withQueryString();
        } else {
            echo '<script>console.log(" No search !")</script>';
            $objectsAry = Usuari::orderBy('username')
                ->paginate(10);
        }
        // - - - - - search block //

        $recursosAry = Recurs::orderBy('codi')->get();

        $rolsAry = Rol::orderBy('nom')->get();

        $request->session()->flashInput($request->input());

        return view('admin.usuari.index', compact('objectsAry', 'recursosAry', 'rolsAry') );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        echo '<script>console.log("create method")</script>';
        $recursosAry = Recurs::orderBy('codi')->get();
        $rolsAry = Rol::orderBy('nom')->get();
        return view('admin.usuari.create', compact( 'recursosAry', 'rolsAry' ) );

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

        if ( !empty( $request->xusername )
            && !empty( $request->xcontrasenya )
            && !empty( $request->xemail)
            && !empty( $request->xnom )
            && !empty( $request->xcognoms )
            && !empty( $request->xrolsid ) ) {

            $theobj = new Usuari;

            $theobj->username = $request->xusername;
            $theobj->contrasenya = \bcrypt($request->xcontrasenya);
            $theobj->email = $request->xemail;
            $theobj->nom = $request->xnom;
            $theobj->cognoms = $request->xcognoms;
            $theobj->rols_id = $request->xrolsid;
            $theobj->recursos_id = $request->xrecursosid;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [UsuariController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [UsuariController::class, 'create'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Username, Contrasenya, Email, Nom i/o Cognoms inexistents' );
            $response = redirect()->action( [UsuariController::class, 'create'] )->withInput();

        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuari  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function show(Usuari $theobj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuari  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuari $theobj)
    {

        echo '<script>console.log("edit method")</script>';
        $recursosAry = Recurs::orderBy('codi')->get();
        $rolsAry = Rol::orderBy('nom')->get();
        return view('admin.usuari.edit', compact('theobj', 'recursosAry', 'rolsAry') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuari  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuari $theobj)
    {
        echo '<script>console.log("store method")</script>';

        if ( !empty( $request->xusername )
            && !empty( $request->xcontrasenya )
            && !empty( $request->xemail)
            && !empty( $request->xnom )
            && !empty( $request->xcognoms )
            && !empty( $request->xrolsid ) ) {

            $theobj->username = $request->xusername;
            if ( !empty( $request->xcontrasenya ) && $request->xcontrasenya != $theobj->contrasenya ) { $theobj->contrasenya = \bcrypt($request->xcontrasenya); }
            $theobj->email = $request->xemail;
            $theobj->nom = $request->xnom;
            $theobj->cognoms = $request->xcognoms;
            $theobj->rols_id = $request->xrolsid;
            $theobj->recursos_id = $request->xrecursosid;

            try {
                $theobj->save();
                $request->session()->flash('mensaje', 'Registre emmagatzemat correctament' );
                $response = redirect()->action( [UsuariController::class, 'index'] );
            } catch( QueryException $ex ) {
                $mensaje = Utility::errorMessage($ex);
                $request->session()->flash('error', $mensaje );
                $response = redirect()->action( [UsuariController::class, 'edit'] )->withInput();
            }

        } else {

            $request->session()->flash('error', 'Username, Contrasenya, Email, Nom i/o Cognoms inexistents' );
            $response = redirect()->action( [UsuariController::class, 'edit'] )->withInput();

        }

        return $response;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuari  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Usuari $theobj)
    {
        echo '<script>console.log("destroy method => theid: '.$theobj->id.'")</script>';

        try {
            $theobj->delete();
            $request->session()->flash('mensaje', 'Registre esborrat correctament' );
        } catch( QueryException $ex ) {
            $request->session()->flash('error', Utility::errorMessage($ex) );
        }

        return redirect()->action( [UsuariController::class, 'index'] );
    }





    /**
     * Show login View
     *
     * @return view()
     */
    public function showLogin(Request $request)
    {

        echo '<script>console.log("Usuari Controller -> showLogin")</script>';

        $admin = Usuari::where( 'username','=', 'admin' )->get();
        if ( !$admin ) {
            $admin = new Usuari();
            $admin->username = 'admin';
            $admin->contrasenya = \bcrypt('admin');
            $admin->email = 'admin@emu061.es';
            $admin->nom = 'Admin';
            $admin->cognoms = 'Emu061';
            $admin->rols_id = 1;
            $admin->save();
            echo '<script>console.log("Usuari Controller -> showLogin -> Add Admin user")</script>';
        }

        return view('auth.login');

    }

    /**
     * Validate login
     *
     * @return Response $response
     */
    public function login(Request $request)
    {

        $username = $request->input('username');
        $contrasenya = $request->input('contrasenya');

        echo '<script>console.log("Usuari Controller -> login -> username: '.$username.' / contrasenya: '.$contrasenya.'")</script>';

        $user = Usuari::where('username', $username)->orwhere('email', $username)->first();

        if ( $user != null && Hash::check($contrasenya, $user->contrasenya)) {

            Auth::login($user, $remember = true);
            //Auth::attempt($user);

            echo '<script>console.log("Usuari Controller -> login -> user: '.$user->nom.' '.$user->cognoms.' ('.$user->email.')")</script>';

            switch ($user->rols_id) {

                //case 1: $response = view('admin.index'); break;
                //case 1: $response = view('admin.index', [Auth::user()]); break;
                case 1: $response = redirect('admin'); break;
                //case 2: $response = view('operator.index'); break;
                //case 2: $response = view('operator.index', [Auth::user()]); break;
                case 2: $response = redirect('operator'); break;
                //case 3: $response = view('mobile.index'); break;
                //case 3: $response = view('mobile.index', [Auth::user()]); break;
                case 3: $response = redirect('mobile'); break;
                //    $request->session()->flash('error', 'Al intenar redireccionar redirect("mobile") se pierde el login del usuario'.
                //        ' Auth::user()->username: '.Auth::user()->username.
                //        ' Auth::id(): '.Auth::id().
                //        ' (user: '.$user->nom.' '.$user->cognoms.' ('.$user->email.')');
                //   $response = redirect('auth.login')->withInput(); break;
                //default: $response = view('index');
                //default: $response = view('index', [Auth::user()]);
                default: $response = redirect('/'); break;

            }

        } else {

            $request->session()->flash('error', 'Usuari o contrasenya incorrectes');
            //$response = redirect('auth.login')->withInput();
            $response = "";

        }

        return $response;

    }


    /**
    * Validate login
    *
    * @return redirect()
    */
    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->flash('error', 'Agraïm la seva elecció ... Fins ara !');

        return redirect('/');

    }




}
