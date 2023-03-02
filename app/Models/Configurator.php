<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configurator extends Model
{
    use HasFactory;

    protected $table = 'configurators';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
      'id',
      'type',
      'title',
      'image',
      'description',
      'button'
    ];
}
