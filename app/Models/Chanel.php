<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chanel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_chanel';
    protected $fillable = ['nama_chanel', 'status'];
}
