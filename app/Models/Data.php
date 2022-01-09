<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;
    protected $table = 'datas';
    protected $fillable = ['nama', 'nilai_1', 'nilai_2', 'nilai_3', 'keterangan'];
}
