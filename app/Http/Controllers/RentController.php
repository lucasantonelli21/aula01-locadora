<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Movie;
use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class RentController extends Controller
{

    public function index(int $id){

        $customer = Customer::find($id);

        if(!$customer) {
            return back()->withErrors("Não foi possível encontrar esse usuário!");
        }

        $movies = $customer->movies;

        return view('rents.index', [
            'movies' => $movies,
            'customer'=> $customer
        ]);

    }

    public function form(int $id){
        $movie = Movie::find($id);
        return view('rents.form',['movie'=>$movie]);
    }

    public function save(Request $request){

        $validator = Validator::make($request->all(), [
            'customer_email' => 'required',
            'pickup_date' => 'required',
            'return_date' =>'required',
        ],[
            'required' => 'O Campo :attribute deve ser preenchido!'
        ]);
        if($validator->fails()){

            return back()->withErrors($validator->errors())->withInput();

        } else{

            $customer = Customer::where('email', 'ilike',  $request->customer_email)->first();

            if(!$customer) {
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
}
