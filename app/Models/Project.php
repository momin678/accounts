<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    
    public function cost()
    {
        return $this->hasMany(Cost::class);
    }
    public function getPayment()
    {
        return $this->hasMany(GetPayment::class);
    }
    public function makePayment()
    {
        return $this->hasMany(MakePayment::class);
    }
    public function suppliers()
    {
        return $this->belongsToMany(MakePayment::class);
    }
    public static function totalPayment($id){
        $total_payment = 0;
        $all_payment = GetPayment::where('project_id', $id)->get();
        foreach($all_payment as $payment){
            $total_payment += $payment->amount;
        }
        return $total_payment;
    }
    public static function totalCost($id){
        $total_cost = 0;
        $all_cost = Cost::where('project_id', $id)->get();
        $all_expenses = MakePayment::where('project_id', $id)->get();
        $all_other_cost = OtherCost::where('project_id', $id)->get();
        foreach($all_cost as $cost){
            foreach(json_decode($cost->amount) as $amount){
                $total_cost += $amount;
            }
        }
        foreach($all_expenses as $cost){
            $total_cost += $cost->amount;
        }
        foreach($all_other_cost as $other_cost){
            foreach(json_decode($other_cost->amount) as $amount){
                $total_cost += $amount;
            } 
        }
        return $total_cost;
    }
}
