<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Rule;
use Livewire\Form;

class PostCreateForm extends Form{

    #[Rule('required')]
    public $title;
    #[Rule('required')]
    public $content;
    #[Rule('required|exists:categories,id')]
    public $category_id;
    #[Rule('required|array')]
    public $tags=[];




    public function save(){
        //veririca las reglas de los atributos
        $this->validate();

        $post=Post::create($this->only('title','content','category_id'));


        $post->tags()->attach($this->tags);
        // attach()  METODO QUE ASIGNA VALORES A UNA TABLA PIVOTE

        //una vez creado y enlazado, limpiamos los inputs
        //actualizar la lista de Post con la accion de crear un nuevo Post


        //$this->postCreateForm->reset(['title','content','category_id','tags']);
        // alternativa
        $this->reset();

    }

}
