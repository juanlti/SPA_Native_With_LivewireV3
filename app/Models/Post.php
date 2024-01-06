<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;

    protected $guarded=[];



    public function Category():BelongsTo{
        // relacion (inversa)  de  post ( 1 ) ---> a Category ( m )

        return $this->belongsTo(Category::class);
    }

    public function tags():BelongsToMany{
        // relacion (inversa) de Tag ( m )  ----> a Post ( m )
      return  $this->belongsToMany(Tag::class);

    }
}
