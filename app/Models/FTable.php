<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FTable extends Model
{
    use HasFactory;
    protected $table = 'f_table';
    protected $primary = 'df1';
    public $timestamps = false;
}
