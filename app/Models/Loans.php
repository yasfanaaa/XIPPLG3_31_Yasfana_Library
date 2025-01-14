<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    use hasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'loans_date',
        'return_date'
    ];
}
