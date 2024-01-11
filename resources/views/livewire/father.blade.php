<div>
    @persist('player')
    <audio src="{{asset('audios/audio1.mp3')}}" controls>

    </audio>
    @endpersist

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

            <script>

                /*
            <script data-navigate-once>
                //para ejcutar por unica vez, agregar el atributo 'data-navigate-once' a la etiqueta script
                // ejemplo 1
               // console.log('hola desde el componente padre');

                // ejemplo 2
              // let a=0;

                // ejemplo 3,
                let a='hola mundo';
                console.log(a);
                    */
                //En ocasiones, las librerias externas (o de teceros), requieren que primero se carga el DOM de la pagina, para luego funcionar

                // Inconveniente con la carga unica del DOM
                //La carga del DOMContentLoaded se realiza por unica vez, sin importar la cantidad de vistas que contenga esa pagina, se carga una vez


                /*  CARGA DEL DOM +  ACTUALIZACION POR CADA REDIRECCIONAMIENTO DE  VISTAS: NO RECOMENDADO !!
                document.addEventListener('DOMContentLoaded',function(){
                    // codigo a ejecutar, posterior a la carga completa del DOM
                    console.log('Hola desde el componente padre, carga DOM');
                })
                // SOLUCION:  al Inconveniente con la carga unica del DOM
                document.addEventListener('livewire:navigated',function(){
                    // codigo a ejecutar, posterior a la carga completa del DOM
                    console.log('Hola desde el componente padre, carga de actualizacion por cada redireccion de pagina');
                })


                 */


            </script>
           {{-- CARGA  DE VISTA CON PUSH Y STACK:  RECOMENDADO !!  --}}
            @push('js')
                <script>
                    // SOLUCION:  al Inconveniente con la carga unica del DOM
                    document.addEventListener('livewire:navigated',function(){
                        // codigo a ejecutar, posterior a la carga completa del DOM
                        console.log('Hola desde el componente padre, carga de actualizacion por cada redireccion de pagina');
                    })
                </script>
            @endpush

        </div>
    </div>
</div>
