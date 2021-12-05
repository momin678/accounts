<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returned extends Model
{
    use HasFactory;
    protected $table = 'returneds';
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
