<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Collection;

class Genre extends Model
{
    use HasFactory;


    protected $guarded = [];
	public $timestamps = false;


    public function web_obtenerGeneros() : Collection {
        return $this->orderBy('title','asc')->get();
    }

}
