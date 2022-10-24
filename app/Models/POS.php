<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POS extends Model
{
    use HasFactory;
    protected $table = 'POS';

    public function POS_CODE(){
        return "{$this->ter_id}";
    }
}
