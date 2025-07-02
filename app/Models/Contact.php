<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'message'];
   //Without fillable, Laravel would throw a MassAssignmentException if you tried to insert these fields using create() or update().
}