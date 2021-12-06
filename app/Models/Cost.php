<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;
    protected $table = 'costs';
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public static function orderCost($invoice_number){
        $orderCost = 0;
        $all_cost = Cost::where('invoice_number', $invoice_number)->first();
        if($all_cost){
            foreach(json_decode($all_cost->amount) as $value){
                $orderCost += $value;
            }
        }
        return $orderCost;
        
    }
}
