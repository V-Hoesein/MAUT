<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    use HasFactory;

    protected $table = 'tb_subkriteria';
    protected $primaryKey = 'id_subkriteria';

    protected $fillable = ['id_subkriteria', 'nama_subkriteria', 'kode_kriteria', 'bobot_subkriteria'];
}
