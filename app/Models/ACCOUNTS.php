<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ACCOUNTS extends Model
{
    use HasFactory;
    protected $table = 'ACCOUNTS';

    protected $fillable = ['TER_ID', 'POS_ID'];
}
