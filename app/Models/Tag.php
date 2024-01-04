<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;

    protected $guarded=[];


    public function Posts():HasMany{
        // relacion de Post ( m ) --->  Tags ( m )
        return $this->hasMany(Post::class);

    }
}
