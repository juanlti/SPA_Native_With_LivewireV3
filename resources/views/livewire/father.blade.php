<div>
    <div>
        <x-button wire:click="redirigir">
            IR A LA PAG SPA

        </x-button>

        <h1 class="text-2x1 font-semibol ">Soy el componente padre</h1>

        Comunicacion Direcional

        <x-input wire:model.live="atributoDeClaseCompartida"></x-input>


        <hr class="my-6">

        <div>
            <livewire:children :atributoDeClaseCompartida="$atributoDeClaseCompartida"/>

            {{-- sintaxis de componente
            @livewire('children',['atributoDeClaseCompartida'=>$atributoDeClaseCompartida])

                sintaxis de etiqueta
                       livewire:nombreDelComponente :atributoNombre="$valorVariable"
                         <livewire:children :atributoDeClaseCompartida="$atributoDeClaseCompartida"/>

        --}}
        </div>
    </div>
</div>
