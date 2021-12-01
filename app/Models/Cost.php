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
}
