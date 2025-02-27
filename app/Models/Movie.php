<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;

class Movie extends Model
{
    use HasFactory;

    /**
     * Filtrar os campoes de filmes, a partir do request
     *
     * @param any $query
     * @param Request $request
     * @return $query
     */
    public function scopeSearch($query, $request) {

        if($request->name) {
            $query->where('name', 'ilike', '%'.$request->name.'%');
        }

        if($request->category) {
            $query->where('category', $request->category);
        }

        if($request->age_indication_min || $request->age_indication_max) {
            if($request->age_indication_max && $request->age_indication_min){
                $query->whereBetween('age_indication', [$request->age_indication_min, $request->age_indication_max]);
            }else{
                if($request->age_indication_min){
                    $query->where('age_indication', '>=', $request->age_indication_min);
                }else{
                    $query->where('age_indication', '<=', $request->age_indication_max);
                }
            }
        }

        if($request->release_date_min || $request->release_date_max) {
            if($request->release_date_max && $request->release_date_min){
                $query->whereBetween('release_date', [$request->release_date_min, $request->release_date_max]);
            }else{
                if($request->release_date_min){
                    $query->where('release_date', '>=', $request->release_date_min);
                }else{
                    $query->where('release_date', '<=', $request->release_date_max);
                }
            }
        }

        return $query;

    }

}
