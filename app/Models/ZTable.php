<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZTable extends Model
{
    use HasFactory;
    protected $table = 'z_table';
    protected $primary = 'z';
    public $timestamps = false;
}
