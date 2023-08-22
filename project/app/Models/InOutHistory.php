<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InOutHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_serial',
        'target_date',
        'time_in',
        'time_out',
        'student_name',
        'student_name_kana',
        'to_mail_address',
        'from_mail_address',
    ];
}
