<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    @persist('player')
    <audio src="{{asset('audios/audio1.mp3')}}" controls>

    </audio>
    @endpersist
    <script>
        //ejemplo  1
        //console.log('hola desde el componente Pagina SPA');


        //ejemplo  2
        /*
        let a=0;
        //setInterval se encarga de ejecutar el siguiente codigo =>{ // codigo } cada 1000 milisegundos
        setInterval(()=>{
        a++;
        console.log(a);
        },1000);

         */

        //ejemplo  3 el tipo de variable const no esta permido en un SPA
        //var a='Hola mundo';
       // console.log(a);
    </script>
</x-app-layout>
