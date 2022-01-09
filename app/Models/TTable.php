<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TTable extends Model
{
    use HasFactory;
    protected $table = 't_table';
    public $timestamps = false;
}
