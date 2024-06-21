<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class watchlist extends Model
{
    use HasFactory;
    protected $table = 'watchlist';
    
    protected $fillable =
    ['job_id','user_id'];
}
