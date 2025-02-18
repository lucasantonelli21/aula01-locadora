<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Função que retorn a view de tabela de Customers.
     *
     * @return void
     */
    public function index(){
        $customers = Customer::orderBy('id', 'desc')->get();
        return view('/customers/index',['customers' => $customers]);
    }

    /**
     * Função responsável por retornar a view do Formulário para cadastro de Customers.
     *
     * @return void
     */
    public function form(){
        return view('/customers/form');
    }


    /**
     * Função que transforma os dados apresentados pelo usuário na Model Customer e salva no DB
     *
     * @param Request $request
     * @return void
     */
    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'birth_date' =>'required',
            'cpf' => 'required|unique:customers',
            'phone' => 'required|unique:customers',
            'able' => 'required'
        ]);
        if($validator->fails()){
            return back()->withInput();
        }else{
            $validated = $validator->validated();
            $customer = new Customer;
            $customer->name = $validated['name'];
            $customer->email = $validated['email'];
            $customer->birth_date = $validated['birth_date'];
            $customer->cpf = $validated['cpf'];
            $customer->phone = $validated['phone'];
            $customer->able = $validated['able'];
            $customer->save();
            return redirect('clientes/');
        }
    }
}
