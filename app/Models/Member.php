<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_member';
    protected $fillable = ['nama_member', 'tgl_mulai', 'id_chanel', 'status', 'tgl_stop', 'tgl', 'lama_sewa', 'total', 'harga_permenit', 'dibayar'];
    protected $dates = ['tgl_mulai', 'tgl_stop'];
}
