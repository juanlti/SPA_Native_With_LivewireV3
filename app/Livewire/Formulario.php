<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Validator;


class Formulario extends Component
{




    public  $categories,$tags;


    // FORMA NUMERO 2, definimos de manera indivual, el atributo a valdiar
    /*
    #[Rule('required',message:'el campo titulo es requerido')]
    public  $title;
    #[Rule('required|exists:categories,id',as:'categoria')]
    public $category_id='';

    #[Rule('required')]
    public $content;

    #[Rule('required|array')]
    public array $selectTag=[];
    */

    /*
    // FORMA NUMERO 3

    #[Rule([
        'postCreate.title'=>'required',
        'postCreate.content'=>'required',
        'postCreate.tags'=>'required|array',
        'postCreate.category_id'=>'required|exists:categories,id|array',

    ],
    ['postCreate.title'=>'titulo']
    )]



    */
    public array $postCreate=[
        'title' => '',
        'content' => '',
        'tags' =>[],
        'category_id' =>'',

    ];
    // FORMA NUMERO 4 (MANERA SIMILAR EN LIVIWIRE 2 )

    public function rules(): array
    {
        return [
            'postCreate.title'=>'required',
            'postCreate.content'=>'required',
            'postCreate.tags'=>'required|array',
            'postCreate.category_id'=>'required|exists:categories,id',

            // agrego la extension para el resto de los formululario
          //  'postEdit.title'=>'required',

            // DESVENTAJA,  SE EJECUTA TODAS LAS REGLAS INDEPENDINETE  DE QU FORMLARIO SE ESTE UTILIZANDO

        ];
    }

    public function messages(){
        //  personalizacion del mensaje de errro
        return [
            'postCreate.title.required'=>'Ingrese un titulo, porfavor',
             'postCreate.content.required'=>'Ingrese el contenido'
        ];
    }

    public function validationAttributes(): array{
        // cambio de nombre del atributo verificado
        return [
            'postCreate.category_id'=>'categoria',
        ];


    }

    public $is_published,$image_path;

    public $openModal=false;

    //$$selectTag almacena los valores selecionados que recibimos por parte del cliente

    public $posts;
    public $postEditId='';


    public $postEdit=[
        // sincronizo cada clave con  su par correspondiente en el modal de edit
        // en el componente modal, ( <x-textarea class="w-full" wire:model="content" required> )  wire:model="postEdit.title"
        // es un arreglo asociativo de  clave ( atributo ) , valor ( contenido de esa clave)
        // EN OTRAS PALABRAS SINCRONIZO EL LIVEWIRE  DE LA ETIQUETA WIRE:MODAL="postEdit.title"
        'title' => '',
        'content' => '',
        'tags' =>[],
        'category_id' =>'',

    ];

    //Metodo Mount carga inicial
    /**
     *
     * @var mixed|null
     */
    private mixed $validate;
    /**
     * @var mixed|null
     */
    private mixed $errors;


    public function edit(Int $idPost){

        //RESETEO  LA ULTIMA VERIFICACION REALIZADA, CON EL FIN DE EVITAR MENSAJES A OBJETOS NO CORRESPONDIENTES
        $this->resetValidation();

        $this->openModal=true;
        // cuando abro el modal, recupero el id para el metodo update
        $this->postEditId=$idPost;




        $edit=Post::find($idPost);



        // una vez recuperado el objeto a modificar, reemplazmos los atributos en el arreglo de carga modal
        $this->postEdit['title']=$edit->title;
        $this->postEdit['category_id']=$edit->category_id;
        $this->postEdit['content']=$edit->content;
        $this->postEdit['tags']=$edit->tags->pluck('id')->toArray();
        //>postEdit['tags']= almacena el valor de la relacion entre post --> tags (m),
        // utiliza el atributo id de las tags (>pluck('id')  y lo convierte en un arreglo




    }

//UPDATE METODO DEL MODAL
    public function update(){

//dump('estoy en actualizacion  '.$this->postEditId);



        // MANERA 4
        // REGLAS DE VALIDACION PERSONALIZADAS PARA CADA FORM
        $this->validate([
            'postEdit.title'=>'required',
            'postEdit.content'=>'required',
            'postEdit.category_id'=>'required|exists:categories,id',
            'postEdit.tags'=>'required|array'
        ]);
        $post=Post::find($this->postEditId);



//$this->postEdit['category_id'],  SON LOS INPUTS (NUEVOS VALORES DEL CLIENTE)
        $post->update([
            'category_id'=>$this->postEdit['category_id'],
            'title'=>$this->postEdit['title'],
            'content'=>$this->postEdit['content'],
        ]);

        //actualizo las etiquetas (o tags) del post del que estoy actualiando
        $post->tags()->sync($this->postEdit['tags']);
        // -> tangs() accedo a la relacion
        // metodo sincronizacion con los valores que tenemos agregados  + los nuevos  sync()
        // ->sync($this->postEdit['tags'])

        // refrrsco de actualizacion de post
        $this->posts=Post::all();
        //fin metodo update


        // reseteo las variables a default
        $this->reset(['postEdit','postEditId','openModal']);

    }

    public function closedModal(){
        $this->openModal=false;
    }

    public function mount(){
        // CARGA DE DATOS DE MANERA INCONDICIONAL
        // $categories contiene la collecion almacenada de categorias
        // $this->categories= Category::all();
        $this->categories= Category::orderBy('id','desc')->get();
        //$this->posts = Post::orderBy('created_at', 'asc')->get();
        // $tags contiene la collecion almacenada de tags
        $this->tags=Tag::all();

        //dd($this->tags);
        //CARGAMOS TODOS LOS POST
        $this->posts=Post::all();


    }
    public function save(){
        // dd("recibo todos los datos para crear un Post");

         // DATOS PARA CREAR EL OBJETO POST
/*
            dd([
                'title'=>$this->postCreate['title'],
                'content'=>$this->postCreate['content'],
                'tags'=>$this->postCreate['tags'],
                'category_id'=>$this->postCreate['category_id'],

            ]);

*/

        /*  FORMA NUMERO 1
        $validatedData  = $this->validate([
            // indicamos las reglas de validaciones con el primer []
            'title' => 'required|min:3',
            'content' => 'required|min:3',
            'selectTag' => 'required|array|min:1',
         'category_id' => 'required|exists:categories,id',

        ],[
            // personalizamos el mensaje de error con el segundo []
            'title.required'=>' el campo titulo es requerido'

        ],[
            // cambiamos el nombre del atributo para validar con el tercer []
            'category_id'=>'categoria'

            ]);
        */
        /*
        //$errors = $this->getErrorBag();

        // Mensajes de error para el campo 'title'
        $errorTitle = $errors->first('title');
        // Mensajes de error para el campo 'content'
        $errorContent = $errors->first('content');
        // Mensajes de error para el campo 'tags'
        $errorTags = $errors->first('selectTag');
        // Mensajes de error para el campo 'category_id'
        $errorCategoryId = $errors->first('category_id');
                */


        // dd($validatedData );

        // FORMA NUMERO 2 (CONTINUACION)
        //$this->validate();
        // FIN DE NUMERO 2
        //$this->createPost($validateData);

        // FORMA NUMERO 3 (CONTINUACION)
        $this->validate(); //  FOROMA NUMERO 3: utliza las reglas de validacion que estan en el metodo #[Rules()]

        $this->createPost2();

    }
    public function createPost2(){

        $newPost = Post::create([

            'title' => $this->postCreate['title'],
            'content' => $this->postCreate['content'],


            'category_id' =>$this->postCreate['category_id'],



        ]);


        $newPost->tags()->attach($this->postCreate['tags']);
        // attach()  METODO QUE ASIGNA VALORES A UNA TABLA PIVOTE

        //una vez creado y enlazado, limpiamos los inputs
        //actualizar la lista de Post con la accion de crear un nuevo Post



        $this->posts=Post::all();
        $this->reset(['postCreate']);


    }
    public function destroy(int $idPost){
        //busco el objeto en la bd
        $postDelete=Post::find($idPost);
        //aplico el metodo delete al objeto a eliminar
        $postDelete->delete();
        //actualizo la lista
        $this->posts=Post::all();

    }


        public function createPost($validateData)
        {


        /*
            // Crea un objeto Post
            $newPost = Post::create([

                'title' => $validatedData['title'],
                'content' => $validatedData['content'],


                'category_id' => $validatedData['category_id'],

            ]);
        */
            /* OTRA FORMA DE CREAR UN OBJETO
            $newPost=Post::create(
                $this->only('category_id','title','content')
            );
            */
        // Una vez creado el objeto Post, accedo a la relacion entre Post y Etiqueta (tag ),
        // la relacion se llama post_tag (tabla pivote)

        //Le asigno el id del nuevo objeto Post a la tabla  post_tag (pivote) como una clave foranea
        // logramos una relacion de 1 a M con la tabla pivote
      //  $newPost->tags()->attach($this->selectTag);
        // attach()  METODO QUE ASIGNA VALORES A UNA TABLA PIVOTE

        //una vez creado y enlazado, limpiamos los inputs
        //actualizar la lista de Post con la accion de crear un nuevo Post

        //$this->posts=Post::all();
        //$this->reset(['title','content','category_id','selectTag']);



}




 public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
 {
     return view('livewire.formulario');
 }

}
