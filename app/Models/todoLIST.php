<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todoLIST extends Model
{
    use HasFactory;
    protected $fillable = ['task', 'description', 'deadline'];
}
