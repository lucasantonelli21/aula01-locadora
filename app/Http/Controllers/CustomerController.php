<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class CustomerController extends Controller
{

    /**
     * Função que retorn a view de tabela de Customers.
     *
     * @return void
     */
    public function index(Request $request) {
        $customers = Customer::search($request)->orderBy('id', 'desc')->paginate($request->pagination ?? 10)->withQueryString();

        return view('customers.index',[
            'customers' => $customers
        ]);

    }


    public function filterPagination(Request $request){
        return redirect()->route('customer.home', ['pagination' => $request['pagination']]);
    }
    /**
     * Função responsável por retornar a view do Formulário para cadastro de Customers.
     *
     * @return void
     */
    public function form() {
        return view('/customers/form');
    }

    /**
     * Função que transforma os dados apresentados pelo usuário na Model Customer e salva no DB
     *
     * @param Request $request
     * @return void
     */
    public function save(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'birth_date' =>'required',
            'cpf' => 'required',
            'phone' => 'required',
            'able' => 'required'
        ],[
            'unique' => 'O Campo :attribute deve ser único!',
            'required' => 'O Campo :attribute deve ser preenchido!'
        ]);

        if($validator->fails()){

            return back()->withErrors($validator->errors())->withInput();

        }else{

            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->birth_date = $request->birth_date;
            $customer->cpf = $request->cpf;
            $customer->phone = $request->phone;
            $customer->able = $request->able;
            $customer->save();

            return redirect()->route('customer.home')->withSuccess("Cliente criado com sucesso!");
        }



    }

    /**
     * Função que deleta um customer com base em seu id
     */
    public function delete(int $id){
        try {
            $customer = Customer::find($id);
            if($customer == null){
                return redirect()->route('customer.home')->withErrors('Não foi encontrado nenhum filme com este Id!');
            }
            $customer->delete();
            return redirect()->route('customer.home')->withSuccess('Filme excluído com sucesso!');
        } catch (\Throwable $th) {
            Log::inf('Deleting movie [CUSTOMERCONTROLLER][DELETE]',$th->error_log);
            return redirect()->route('customer.home')->withErrors('Sistema indisponível, tente mais tarde!');
        }
    }

     /**
     * Retorna a View do formulário de edit
     *
     * @param integer $id
     * @return void
     */
    public function formEdit(int $id){
        $customer = Customer::find($id);
        return view('/customers/update',['customer' => $customer]);
    }

    /**
     * Atualiza um Customer no DB
     */

    public function update(Request $request,int $id){
        // try {
            $customer = Customer::find($id);
            if($customer == null){
                return redirect()->route('customer.home')->withErrors('Não foi encontrado nenhum cliente com este Id!');
            }

            $validator = Validator::make($request->all(), [
                'email' => 'nullable',
                'cpf' => 'nullable',
                'phone' => 'nullable',
            ]);

            $validator->after(function ($validator) use($request,$customer) {
                $fields = [
                    'email' => $request->email,
                    'cpf' => $request->cpf,
                    'phone' => $request->phone,
                ];

                foreach($fields as $field => $value){
                    $customerToUpdate = Customer::where($field,'ilike',$value)->first();
                    if($customerToUpdate->id != $customer->id){
                        $validator->erros()->add($field,$field.' Deve ser Único por cliente');
                    }
                }
            });

            if($validator->fails()){
                return back()->withErrors($validator->errors())->withInput();
            }

            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->birth_date = $request->birth_date;
            $customer->cpf = $request->cpf;
            $customer->phone = $request->phone;
            $customer->able = $request->able;
            $customer->save();

            return redirect()->route('customer.home')->withSuccess('Cliente editado com sucesso!');

        // // } catch (\Throwable $th) {

        //     Log::inf('Updating movie [CUSTOMERCONTROLLER][UPDATE]',$th->error_log);
        //     return redirect()->route('customer.home')->withErrors('Sistema indisponível, tente mais tarde!');

        // // }
    }

}
