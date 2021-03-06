<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakePayment extends Model
{
    use HasFactory;
    protected $table = 'make_payments';
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
