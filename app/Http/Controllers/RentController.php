<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Movie;
use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RentController extends Controller
{
    /**
     * Retorna a view index dos alugueis
     */
    public function index(int $id)
    {

        // se é usuario {}
        $customer = Customer::find($id);

        if (!$customer) {
            return back()->withErrors("Não foi possível encontrar esse usuário!");
        }

        $movies = $customer->movies;

        // se não
        $movies = Movie::all();



        return view('rents.index', [
            'movies' => $movies,
            'customer' => $customer
        ]);
    }

    /**
     * Retorna a view para cadastro de um aluguel
     *
     * @param integer $id
     * @return void
     */
    public function form(int $id)
    {
        $movie = Movie::find($id);
        $customers = Customer::get();
        return view('rents.form', ['movie' => $movie, 'customers' => $customers]);
    }

    /**
     * Sala um novo aluguel na pivot table
     *
     * @param Request $request
     * @return void
     */
    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'pickup_date' => 'required',
            'return_date' => 'required',
        ], [
            'required' => 'O Campo :attribute deve ser preenchido!'
        ]);

        if (!$request->customer_email) {

            $validator->after([function ($validator) {
                if (Auth::user()->is_admin) {
                    $validator->errors()->add('email', 'Não foi passado o e-mail do usuário para quem deseja logar o filme!');
                }
            }]);
        }

        if ($validator->fails()) {

            return back()->withErrors($validator->errors())->withInput();
        } else {


            $customer = Customer::where( Auth::user()->is_admin ? 'id' : 'email', 'ilike',  Auth::user()->is_admin ? $request->customer_email : Auth::user()->email)->first();

            if (!$customer) {
                return back()->withErrors('Não foi encontrado nenhum usuário com esse e-mail!');
            }

            $customer->movies()->attach([
                $request->movie_id => [
                    'price' => 200,
                    'pickup_date' => $request->pickup_date,
                    'return_date' => $request->return_date
                ]
            ]);

            return redirect()->route('movie.home')->withSuccess("Filme $request->movie_id alugado com sucesso para $customer->name!");
        }
    }

    /**
     * Deleta um determinado aluguel da pivot table
     *
     * @param integer $id
     * @param integer $rentId
     * @return void
     */

    public function delete(int $id, int $rentId)
    {
        try {
            $customer = Customer::find($id);
            if (!$customer) {
                return back()->withErrors("Cliente não existe");
            }
            $movies = $customer->movies;
            foreach ($movies as $movie) {
                if ($movie->pivot->id == $rentId) {
                    $rent = $movie->pivot;
                    $movieId = $movie->id;
                    break;
                }
            }
            if (!$rent) {
                return back()->withErrors("Aluguel não existe");
            }
            $customer->movies()->detach([$movieId]);

            return back()->withSuccess('Aluguel excluído com sucesso!');
        } catch (\Throwable $th) {
            Log::inf('Deleting movie [RENTCONTROLLER][DELETE]', ['Erro' => $th->error_log]);
            return back()->withErrors('Sistema indisponível, tente mais tarde!');
        }
    }

    public function formEdit(int $id, int $rentId)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return back()->withErrors("Cliente não existe");
        }
        $movies = $customer->movies;
        foreach ($movies as $movie) {
            if ($movie->pivot->id == $rentId) {
                $rent = $movie->pivot;
                $movieToEdit = $movie;
                break;
            }
        }
        if (!$rent) {
            return back()->withErrors("Aluguel não existe");
        }
        return view('rents.update', ['movie' => $movieToEdit, 'customer' => $customer, 'rent' => $rent]);
    }

    public function update(int $id, int $rentId, Request $request)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return back()->withErrors("Cliente não existe");
        }
        $movies = $customer->movies;
        foreach ($movies as $movie) {
            if ($movie->pivot->id == $rentId) {
                $rent = $movie->pivot;
                $movieId = $movie->id;
                break;
            }
        }
        if (!$rent) {
            return back()->withErrors("Aluguel não existe");
        }
        $customer->movies()->detach([$movieId]);
        $customer->movies()->attach([
            $movieId => [
                'price' => $rent->price + 100,
                'pickup_date' => $rent->pickup_date,
                'return_date' => $request->return_date
            ]
        ]);
        return redirect()->route('customer.rent.home', $customer->id)->withSuccess("Atraso para devolução feito com succeso. Confira sua nova tarifa!");
    }
}
