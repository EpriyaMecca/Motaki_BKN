<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tb_task';

    protected $fillable = [
        'name',
        'description',
        'status',
        'start_date',
        'due_date',
        'finish_date',
        'keterangan',
        'skor_utama',
        'skor_tambahan'
    ];
}
