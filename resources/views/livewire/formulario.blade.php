<div>
    {{-- The whole world belongs to you. --}}

    <div class="bg-white shadow rounded-lg p-8">

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
    <div class="bg-white shadow rounded-lg p-6">
        <ul class="list-disc list-inside"> {{--Lista  --}}
            @foreach($posts as $post)
                <li>
                    {{$post->title}}
                </li>

            @endforeach


        </ul>
    </div>

</div>
