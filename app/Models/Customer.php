<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Customer extends Model
{
    use HasFactory;

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class)->withPivot('id','price', 'pickup_date', 'return_date');
    }

    public function scopeSearch($query, $request) {

        if($request->name){
            $query->where('name', 'ilike', '%'.$request->name.'%');
        }

        if($request->email){
            $query->where('email', 'ilike', $request->email);
        }

        if($request->cpf){
            $query->where('cpf', 'ilike', '%'.$request->cpf.'%');
        }

        if($request->phone){
            $query->where('phone', 'ilike', '%'.$request->phone.'%');
        }

        if($request->able || $request->able != null){
            $query->where('able', $request->able);
        }

        if($request->birth_date_min || $request->birth_date_max){

            if($request->birth_date_max && $request->birth_date_min){
                $query->whereBetween('birth_date', [$request->birth_date_min, $request->birth_date_max]);
            }else{
                if($request->birth_date_min){
                    $query->where('birth_date', '>=', $request->birth_date_min);
                }else{
                    $query->where('birth_date', '<=', $request->birth_date_max);
                }
            }

        }

        return $query;
    }


}
