<?php

namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;


class Formulario extends Component
{



    public $openModal=false;
    public  $categories,$tags;
    public $is_published,$image_path;

    //ATRIBUTOS PARA LA CLASE POSTCREATEFORM
    public PostCreateForm $postCreateForm;
    public $posts,$newPost;

    //ATRIBUTOS PARA LA CLASE POSTEDITFORM

     public PostEditForm $postEditForm;









    //$$selectTag almacena los valores selecionados que recibimos por parte del cliente





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

        //llamo al objecto de la instancia PostCreateForm y ejecuto su metodo save()
        $this->postCreateForm->save();

        $this->posts=Post::all();



    }
    public function destroy(int $idPost){
        //busco el objeto en la bd
        $postDelete=Post::find($idPost);
        //aplico el metodo delete al objeto a eliminar
        $postDelete->delete();
        //actualizo la lista
        $this->posts=Post::all();

    }




 public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
 {
     return view('livewire.formulario');
 }

}
