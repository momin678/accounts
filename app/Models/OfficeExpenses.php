<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeExpenses extends Model
{
    use HasFactory;
    protected $table = 'office_expenses';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
