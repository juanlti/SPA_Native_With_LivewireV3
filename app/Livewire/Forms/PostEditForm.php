<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostEditForm extends Form
{
    //
    #[Rule('required')]
    public $title;

    #[Rule('required')]
    public $content;

    #[Rule('required|array')]
    public $tags=[];

    #[Rule('required|exists:categories,id')]
    public $category_id='';
    public $postEditId='';
    public $openModal=false;
    public $post;

    public function edit($postId){
        //Orden n: 1 (abrir modal)
        // responsabilidad del metodo: abrir el modal + cargar los datos del objeto a modificar
        $this->openModal=true;

        //Orden n: 2 (persistir el dato del elemento a modificar)
       $this->postEditId=$postId;
       //la instancia del objeto, accedo a la variable postEditId y le asigno el valor de $postId

            // busco el objeto a modificar
          $post=Post::find($postId);
        // le asgino a los atributos los nuevos valores corresponientes
        $this->title=$post->title;
        $this->category_id=$post->category_id;
        $this->content=$post->content;
        $this->tags=$post->tags->pluck('id')->toArray();


        //muestros  los valores del objetos a modificar

    }

    public function update(){
        //responsabilidad del metodo update: actualizar con los nuevos valores a la bd


    }


}
