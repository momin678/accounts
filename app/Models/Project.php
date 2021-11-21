<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    
    public function payment(){
        return $this->hasMany(GetPayment::class);
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
        $all_expenses = Expense::where('project_id', $id)->get();
        foreach($all_cost as $cost){
            foreach(json_decode($cost->amount) as $amount){
                $total_cost += $amount;
            }
        }
        foreach($all_expenses as $cost){
            $total_cost += $cost->amount;
        }
        return $total_cost;
    }
}
