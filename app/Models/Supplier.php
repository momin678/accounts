<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    public function supply_value(){
        return $this->hasMany(Cost::class);
    }
    public function make_payment(){
        return $this->hasMany(MakePayment::class);
    }
}
