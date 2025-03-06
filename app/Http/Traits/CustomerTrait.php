<?php
namespace App\Http\Traits;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
trait CustomerTrait {

    public static function createCustomer(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:customers',
            'birth_date' =>'required',
            'cpf' => 'required|unique:customers',
            'phone' => 'required|unique:customers',
        ],[
            'unique' => 'O Campo :attribute deve ser único!',
            'required' => 'O Campo :attribute deve ser preenchido!'
        ]);

        if($validator->fails()){

            return back()->withErrors($validator->errors())->withInput();

        }
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->birth_date = $request->birth_date;
        $customer->cpf = $request->cpf;
        $customer->phone = $request->phone;
        $customer->able = true;
        $customer->save();
    }

    public static function findCustomer($userEmail){
        $customer = Customer::where('email', 'ilike',  $userEmail)->first();
        return $customer->id;
    }
}
