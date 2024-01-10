<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Comments extends Component
{

    public $comments=[];


    #[On('post-created')]
    public function addComment($messages){

        array_unshift($this->comments,$messages);
        //array_unshift de php, ( arreglo. elementoNuevo ). este metod agrega un elemento a un arreglo existente
    }
    public function render()
    {
        return view('livewire.comments');
    }
}
