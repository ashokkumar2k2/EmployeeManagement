<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jobs extends Model
{
    use HasFactory;
    protected $table = 'jobs';
    protected $fillable =
    ['job_role','location','experience','qualification','salary','job_image'];
}
