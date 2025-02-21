<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

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
    public function index(Request $request) {

        $movies = Movie::orderBy('id', 'desc')->paginate($request->pagination ?? 10);

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
        ],[
            'required' => 'O Campo :attribute deve ser preenchido!'
        ]);

        if($validator->fails()){

            return back()->withErrors($validator->errors())->withInput();

        } else {

            $movie = new Movie;
            $movie->name = $request->name;
            $movie->description = $request->description;
            $movie->category = $request->category;
            $movie->age_indication = $request->age_indication;
            $movie->duration = $request->duration;
            $movie->release_date = $request->release_date;
            $movie->is_fan = $request->is_fan;
            $movie->save();

            return redirect()->route('movie.home')->withSuccess("Filme criado com sucesso!");
        }

    }


    /**
     * Dedeleteleta um Filme com base em um Id
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id){
        try {
            $movie = Movie::find($id);
            if($movie == null){
                return redirect()->route('movie.home')->withErrors('Não foi encontrado nenhum filme com este Id!');
            }
            $movie->delete();
            return redirect()->route('movie.home')->withSuccess('Filme excluído com sucesso!');
        } catch (\Throwable $th) {
            Log::inf('Deleting movie [MOVIECONTROLLER][DELETE]',$th->error_log);
            return redirect()->route('movie.home')->withErrors('Sistema indisponível, tente mais tarde!');
        }
    }

    /**
     * Retorna a View do formulário de edit
     *
     * @param integer $id
     * @return void
     */
    public function formEdit(int $id){
        $movie = Movie::find($id);
        return view('/movies/update',["movie" => $movie]);
    }

    /**
     * Edita os dados que precisam ser editados e mantem os que não precisam
     *
     * @param integer $id
     * @param Request $request
     * @return void
     */
    public function update(int $id, Request $request){
        try {

            $movie = Movie::find($id);
            if($movie == null){
                return redirect()->route('movie.home')->withErrors('Não foi encontrado nenhum filme com este Id!');
            }

            $movie->name = $request->name ? $request->name : $movie->name;
            $movie->description = $request->description ? $request->description : $movie->description;
            $movie->category = $request->category ? $request->category : $movie->category;
            $movie->age_indication = $request->age_indication ? $request->age_indication : $movie->age_indication;
            $movie->duration = $request->duration ? $request->duration : $movie->duration;
            $movie->release_date = $request->release_date ? $request->release_date : $movie->release_date;
            $movie->is_fan = $request->is_fan ? $request->is_fan : $movie->is_fan;
            $movie->save();

            return redirect()->route('movie.home')->withSuccess('Filme editado com sucesso!');

        } catch (\Throwable $th) {

            Log::inf('Updating movie [MOVIECONTROLLER][UPDATE]',$th->error_log);
            return redirect()->route('movie.home')->withErrors('Sistema indisponível, tente mais tarde!');

        }
    }

}
