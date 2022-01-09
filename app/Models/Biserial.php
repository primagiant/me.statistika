<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biserial extends Model
{
    use HasFactory;
    protected $table = 'biserials';
    protected $fillable = ['A', 'B'];
}
