<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    use HasFactory;
    	public function class()
    	{
    		return $this->BelongsTo('App\Models\ClassModel');
    	}
}
