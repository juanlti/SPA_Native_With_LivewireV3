<?php

namespace App\Livewire;

use Livewire\Component;

class Father extends Component
{

    public $atributoDeClaseCompartida="Hola";
    public $atributoDeClaseCompartidaBidireccional="Adios";


    public function redirigir(){
        // sin comportamiento de spa  ir a pagina ->
        //return redirect()->to('https://www.google.com/');

        // con comportamiento  de spa
        return $this->redirect('/viewSpa',navigate:true);



}

    public function render()
    {
        return view('livewire.father');
    }
}
