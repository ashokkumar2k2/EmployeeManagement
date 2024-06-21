<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jobs_applied extends Model
{
    use HasFactory;

    protected $table = 'jobs_applied';
    
    protected $fillable =
    ['job_id','user_id'];
}
