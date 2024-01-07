<div>
    {{-- The whole world belongs to you. --}}

    <div class="bg-white shadow rounded-lg p-6 mb-8">

        <form wire:submit.prevent="save">

            <div class="mb-4">
                {{-- secion  01 del formulario --}}
                @error('title') <span>{{ $message }}</span> @enderror
                <label>
                    Nombre
                </label>
                <input type="text" class="w-full" wire:model="title" required>
            </div>

            <div class="mb-4">
                <x-label>
                    Contenido

                </x-label>

                <x-textarea class="w-full" wire:model="content" required>


                </x-textarea>
            </div>
            {{-- secion  02 del formulario --}}
            <div class="mb-4 ">

                <label for="">

                    <x-select class="w-full" wire:model="category_id" required>
                        <option value="" disabled>Selecione una Categoria</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">
                                {{$category->name}}
                            </option>

                        @endforeach

                    </x-select>
                </label>
            </div>
            <div>
                <ul>
                    @foreach($tags as $tag)
                        <li>
                            <label>
                                <x-checkbox type="checkbox" value="{{$tag->id}}" wire:model="selectTag">

                                </x-checkbox>
                                {{$tag['title']}}

                            </label>
                        </li>
                    @endforeach


                </ul>
            </div>


            <div class="flex justify-end">
                <x-button>
                    Guardar Datos

                </x-button>

            </div>

        </form>
    </div>




{{--  {{"nombre del formulario".$formularioNombre}}  --}}
<div class="bg-white shadow rounded-lg p-6 mt-4">
    <ul class="list-disc list-inside space-y-2"> {{--Lista  --}}
        @foreach($posts as $post)
            <li class="flex justify-between" wire:key="post--{{$post->id}}">
                {{-- CORRECTO FUNCIONAMIENTO DE RENDERIZADO PARA UNA COLECCION QUE VA SE ACTUALIZANDO EN TODO MOMENTO--}}
                {{-- LOGRAMOS UNA SEPARACION --}}

                {{$post->title}}
                {{--  {{$post->title}} izquierda --}}

                <div>
                    {{-- bottones a la derecha --}}
                    <x-button wire:click="edit({{$post->id}})">
                        Editar
                    </x-button>


                    <x-danger-button  wire:click="destroy({{$post->id}})"  wire:confirm="Esta seguro que desea eliminar esta publicacion ?">
                       Eliminar
                    </x-danger-button >
                </div>

            </li>

        @endforeach


    </ul>

    </div>



{{-- MODAL--}}
{{-- OCULTAMOS MODAL--}}
@if($openModal)

    {{-- formulario de edicion--}}
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
            <div class="py-12">
        {{-- CENTRAMOS EL CONTENIDO --}}
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            {{--  contenido centrodo ==>   holaaa  --}}
            <div class="bg-white shadow rounded-lg p-6">

                <form wire:submit.prevent="update">

                    <div class="mb-4">
                        {{-- secion  01 del formulario --}}
                        @error('title') <span>{{ $message }}</span> @enderror
                        <label>
                            Nombre
                        </label>
                        <input type="text" class="w-full" wire:model="postEdit.title" required>
                    </div>

                    <div class="mb-4">
                        <x-label>
                            Contenido

                        </x-label>

                        <x-textarea class="w-full" wire:model="postEdit.content" required>


                        </x-textarea>
                    </div>
                    {{-- secion  02 del formulario --}}
                    <div class="mb-4 ">

                        <label for="">
                            Categorias

                            <x-select class="w-full" wire:model="postEdit.category_id" required>
                                <option value="" disabled>Selecione una Categoria</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{$category->name}}
                                    </option>

                                @endforeach

                            </x-select>
                        </label>
                    </div>
                    <div>
                        <ul>
                            @foreach($tags as $tag)
                                <li>
                                    <label>
                                        <x-checkbox type="checkbox" value="{{$tag->id}}"
                                                    wire:model="postEdit.tags">

                                        </x-checkbox>
                                        {{$tag['title']}}

                                    </label>
                                </li>

                            @endforeach


                        </ul>
                    </div>


                    <div class="flex justify-end">
                        <x-button class="mr-2">

                            Actualizar

                        </x-button>
                        <x-danger-button wire:click="$set('openModal',false)">
                            Cancelar

                        </x-danger-button>


                    </div>


                </form>

            </div>
        </div>

    </div>

    @endif
    </div>

</div>
