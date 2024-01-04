<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded=[];


    //relaciones a nivel de Eloquent


    public function posts():HasMany{
        // relacion de Category ( m ) ---> post ( 1 )
         return $this->hasMany(Post::class);
    }

}
