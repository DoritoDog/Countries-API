<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'yearOfPopulation',
        'population'
    ];

    public static function getByFilters(?string $name = null, ?string $code = null, ?int $year = null, ?int $population = null)
    {
         $queryBuilder = DB::table('countries');
        // Filters the data.
        if ($name !== null) {
            $queryBuilder->where('name', 'like', "%$name%");
        }
        if ($code !== null) {
            $queryBuilder->where('code', $code);
        }
        if ($year !== null) {
            $queryBuilder->where('yearOfPopulation', $year);
        }
        if ($population !== null) {
            $queryBuilder->where('population', $population);
        }

        return $queryBuilder->orderBy('name')
            ->paginate(15);
    }
}
