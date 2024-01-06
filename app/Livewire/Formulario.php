<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;
use Validator;


class Formulario extends Component
{

    public  $categories,$tags;

    public  $title,$category_id='',$content,$is_published,$image_path;


    public array $selectTag=[];
    //$$selectTag almacena los valores selecionados que recibimos por parte del cliente

    public $posts;

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
    /*
     * DATOS PARA CREAR EL OBJETO POST
        dd([
                'title'=>$this->title,
            'content'=>$this->content,
            'tags'=>$this->selectTag,
            'category_id'=>$this->category_id,

        ]);
    */
        $validatedData  = $this->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:3',
            'selectTag' => 'required',
         'category_id' => 'required|numeric',
        ]);
        $errors = $this->getErrorBag();

        // Mensajes de error para el campo 'title'
        $errorTitle = $errors->first('title');
        // Mensajes de error para el campo 'content'
        $errorContent = $errors->first('content');
        // Mensajes de error para el campo 'tags'
        $errorTags = $errors->first('selectTag');
        // Mensajes de error para el campo 'category_id'
        $errorCategoryId = $errors->first('category_id');


       // dd($validatedData );
        $this->createPost($validatedData);

        //actualizar la lista de Post con la accion de crear un nuevo Post
        $this->posts=Post::all();

    }

    public function createPost($validatedData)
    {
        // Crea un objeto Post
        $newPost = Post::create([

            'title' => $validatedData['title'],
            'content' => $validatedData['content'],


            'category_id' => $validatedData['category_id'],

        ]);
        /* OTRA FORMA DE CREAR UN OBJETO
        $newPost=Post::create(
            $this->only('category_id','title','content')
        );
        */
        // Una vez creado el objeto Post, accedo a la relacion entre Post y Etiqueta (tag ),
        // la relacion se llama post_tag (tabla pivote)

        //Le asigno el id del nuevo objeto Post a la tabla  post_tag (pivote) como una clave foranea
        // logramos una relacion de 1 a M con la tabla pivote
        $newPost->tags()->attach($this->selectTag);

        //una vez creado y enlazado, limpiamos los inputs

        $this->reset(['title','content','category_id','selectTag']);



    }


    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.formulario');
    }

}
