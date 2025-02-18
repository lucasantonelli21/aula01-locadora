<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Controle de Filmes
 */
class MovieController extends Controller
{

    /**
     * Visualizar tabela de dados
     *
     * @return void
     */
    public function index() {

        $movies = Movie::orderBy('id', 'desc')->get();

        return view('/movies/index', [
            'movies' => $movies
        ]);
    }

    /**
     * Redirecionar para a tela do formulario
     *
     * @return void
     */
    public function form() {
        return view('/movies/form');
    }

    /**
     * Salvar registro no banco de dados
     *
     * @return void
     */
    public function save(Request $request) {


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            'age_indication' =>'required',
            'duration' => 'required',
            'release_date' => 'required',
            'description' => 'required',
            'is_fan' => 'required'
        ]);

        if($validator->fails()){
            return back()->withInput();
        } else {
              $validated = $validator->validated();
              $movie = new Movie;
              $movie->name = $validated['name'];
              $movie->description = $validated['description'];
              $movie->category = $validated['category'];
              $movie->age_indication = $validated['age_indication'];
              $movie->duration = $validated['duration'];
              $movie->release_date = $validated['release_date'];
              $movie->is_fan = $validated['is_fan'];
              $movie->save();

              return redirect('filmes/');
        }




    }

}
