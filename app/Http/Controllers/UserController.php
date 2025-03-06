<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Movie;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\CustomerTrait;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function formRegister(){
        return view('register');
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required | unique:users',
            'password' => 'required',
        ],[
            'unique' => 'O Campo :attribute deve ser único!',
            'required' => 'O Campo :attribute deve ser preenchido!'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput();
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = true;
        CustomerTrait::createCustomer($request);
        $customerId = CustomerTrait::findCustomer($request->email);
        $user->customer_id = $customerId;
        $user->save();
        return redirect()->route('home')->withSuccess('Parabéns!! Registro realizado com sucesso!');
    }

    public function profile(){
        $customer = Customer::find(Auth::user()->customer_id);
        return view('user.profile',[
            'customer' => $customer
        ]);
    }

    public function getFormEdit(){
        $customer = Customer::find(Auth::user()->customer_id);
        return view('user.form-edit',[
            'customer' => $customer
        ]);
    }

    public function update(Request $request){

        $customer = Customer::find(Auth::user()->customer_id);

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
                if($customerToUpdate && $customerToUpdate->id != $customer->id){
                    $validator->errors()->add($field,$field.' Deve ser Único por cliente!');
                }
            }

            if($request->show_password){
                if($request->new_password == ''){
                    $validator->errors()->add($request->new_password,'Você deve preencher o campo da sua nova senha!');
                }

                if($request->password_confirmation == ''){
                    $validator->errors()->add($request->password_confirmation,'Você deve confirmar sua senha!');
                }

                if($request->new_password != $request->password_confirmation){
                    $validator->errors()->add($request->new_password,'Sua nova senha deve ser igual a confirmação de senha!');
                }

                if(!Hash::check($request->password,Auth::user()->password)){
                    $validator->errors()->add($request->password,'Senha antiga inválida!');
                }
            }
        });

        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput();
        }

        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        if($request->show_password){
            $user->password = Hash::make($request->new_password);
        }
        $customer->email = $request->email;
        $customer->cpf = $request->cpf;
        $customer->phone = $request->phone;
        $user->save();
        $customer->save();
        return redirect()->route('user.profile',[
            'customer' => $customer
        ])->withSuccess('Informações alteradas com sucesso!');
    }


}
