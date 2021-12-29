<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $table = 'salaries';
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public static function salaryAmount($employee_id){
        $totalAmount = Salary::where('employee_id', $employee_id)->select('amount')->get();
        $amount = 0;
        foreach($totalAmount as $amounts){
            $amount += $amounts->amount;
        }
        return $amount;
    }
}
