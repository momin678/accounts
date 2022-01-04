<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    public static function delete_brand($id){
        $brand = Brand::findOrFail($id);
        if(!is_null($brand)){
            $brand->delete();
        }
    }
}
