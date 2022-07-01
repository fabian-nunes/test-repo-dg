<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    use HasFactory;
    protected $table = 'monitor';

    public function patient() {
        return $this->belongsTo(Patient::class);
    }
}
