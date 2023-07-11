<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenralSettings extends Model
{
    use HasFactory;

    protected $table = "genral_settings";
    protected $primaryKey = "id";
    protected $fillable=["key", "value", "parent"];

    protected static function makeFlat($collection)
    {
        return $collection->map(function($val, $idx){
            return [
                $val->key => $val->value,
            ];
        })->flatMap(function($val){
            return $val;
        });
    }
}
