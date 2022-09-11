<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Empleado extends Model
{
	public $timestamps = false;
	protected $fillable = ['nombre','apellido','edad'];
    use HasFactory;
}
