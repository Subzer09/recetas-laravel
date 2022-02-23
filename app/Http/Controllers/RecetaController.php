<?php

namespace App\Http\Controllers;

use App\Models\CategoriaReceta;
use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        Auth::user()->recetas->dd();
        $recetas = auth()->user()->recetas;
        return view('recetas.index', compact("recetas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        DB::table('categoria_receta')->get()->dd();
        $categorias = DB::table('categoria_receta')->get()->pluck('nombre', 'id');

        return view('recetas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());

//        dd($request['imagen']->store('upload-recetas', 'public'));

        //validacion del formulario

        $data = request()->validate([
            'titulo' => 'required|min:4',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image',
        ]);

        //almacenamos la imagen y obtenemos la ruta
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

//        DB::table('recetas')->insert([
//            'titulo' => $data['titulo'],
//            'ingredientes' => $data['ingredientes'],
//            'preparacion' => $data['preparacion'],
//            'user_id' => Auth::user()->id,
//            'categoria_id' => $data['categoria'],
//            'imagen' => $ruta_imagen,
//        ]);
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'categoria_id' => $data['categoria'],
            'imagen' => $ruta_imagen,
        ]);
        return redirect()->route('recetas.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receta = Receta::findOrFail($id);
        return view('recetas.show', compact("receta"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        $receta = Receta::findOrFail($id);
        return view('recetas.edit', compact("categorias", "receta"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $receta = Receta::findOrFail($id);
        //Revisar el policy
        $this->authorize('update', $receta);

        $data = request()->validate([
            'titulo' => 'required|min:4',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
        ]);

        // Asignar los valores
        $receta->titulo = $data['titulo'];
        $receta->preparacion = $data['preparacion'];
        $receta->categoria_id = $data['categoria'];


        // Si el usuario sube una nueva imagen
        if (request('imagen')) {
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');
            $receta->imagen = $ruta_imagen;
        }


        $receta->save();

        return redirect()->route('recetas.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        return "eliminando...";
        $receta = Receta::findOrFail($id);
        //Revisar el policy
        $this->authorize('delete', $receta);

        //Eliminamos la receta
        $receta->delete();
        return redirect()->route('recetas.index');

    }
}
