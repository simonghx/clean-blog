## Importer un thème

 - Copier le fichier theme dans notre projet
 
 - Importer les fichiers css,img,js et vendor du fichier du blog dans un dossier "theme" que l'on va créer dans notre dossier "public".

## Organisation de l'html dans les blades

 - Transporter l'html du ficheir du theme dans le "welcome.blade.php" 
 - Créer dans le dossier views, un dossier "layouts" . Dans ce dossier "layouts", créer un fichier "front.blade.php"
 - Créer dans le dossier views également, un dossier "partials" qui va contenir un "nav.blade.php" et un "footer.blade.php"
 - Puis tout découper ,voir les blades du projet "ProjetAideUltime"
 - Pour toutes les images, les link et les scrpits --> placez tous les liens dans des {{assets ''}}. Par ex: 
  `url('{{assets("theme/img/home-bg.jpg")}}')`
 - List item

## Récupérer la base de donnée de Jeroen

 - Aller sur ce lien https://github.com/jeroennoten/Laravel-AdminLTE

copier --> 


composer require jeroennoten/laravel-adminlte

ET LE TAPER DANS LE TERMINAL




 copier --> 
 
php artisan vendor:publish --provider="JeroenNoten\LaravelAdminLte\ServiceProvider" --tag=assets   
ET LE TAPER DANS LE TERMINAL





 - Ensuite 1 fois --> --tag=assets
                  1 fois --> --tag=views
                  1 fois --> --tag=config





 - Puis--> 
php artisan make:adminlte
dans le terminal


## Aller sur phpmyadmin et créer une base de données

 - Aller dans le fichier .env de note projet puis changer le nom de la DATABASE --> lastchance
 - Puis changer l'username et la mot de passe en 'root' et 'root'

##### Cela va permettre de lier la base de données "lastchance" que l'on a crée dans le phpMyAdmin avec notre projet.

 - Puis faire un --> php artisan migrate


## Aller sur l'AdminLTE avec le /login et s'enregistrer

S'enregister dans l'AdminLTE et l'ouvrir

##### changer le bootstrap 3 en bootstrap 4

 - Aller dans resources->views->vendor->adminlte->master.blade.php

 - Puis aller sur la ligne de Bootstrap 3.3.7 la remplacer par    <link  rel="stylesheet"  href="{{  asset('css/app.css') }}">


## Création d'un model pour la base de données

Taper --> php artisan make:model Post -a

Cela va créer un fichier "factory", un ficher de "migration" et un fichier "controller" et un fichier "provider"


## Créer des tables dans le fichier de migration

https://laravel.com/docs/5.6/migrations --> pour voir les commandes de saisies possibles pour les tables du fichier "migration"

"Voir le projet "ProjetAideUltime" pour voir le résultat"


Puis faire un php artisans migrate


## Créer de faux utilisateurs dans la factory

 - Aller dans laravel-faker sur google pour savoir créer des faker
 - Puis créer les "faker" que l'on veut


## Créer le Seeder qui va permettre de mettre ce que la factory fabrique dans notre phpMyAdmin

-->  php artisan make:seeder PostTableSeeder

 - Dans le seeder, en l'occurrence PostTableSeeder, on va appeler la factory avec `factory(App\Post::class, 10) ->create();`
    
 Cela va permettre de créer 10 fois ce que l'on a construit dans la factory ( PostFactory ) dans le phpMyAdmin

Puis faire un `php artisan migrate:fresh` pour rafraîchir le tout

 - Puis taper `$this->call(PostTableSeeder::class);` dans le DataBaseSeeder.php pour que celui-ci appel le PostTableSeeder qui contient la production de la factory (PostFactory)

 - Puis taper `php artisan db:seed` pour démarrer le seed qui va permettre d'envoyer ces données dans le phpMyAdmin


##### Les 10 Posts seront affichés dans le fichier "posts" de la base de donnée "lastchance"

## Création d'un UserSeeder pour ne plus s'enregistrer à chaque fois 

 - Taper --> `php artisan make:seeder UserTableSeeder` pour créer un UserTableSeeder

 - Aller dans le DataBaseSeeder et taper `$this->call(UserTableSeeder::class);` pour l'appeler comme pour le PostTableSeeder.

 - Dans le UserTableSeeder --> 
 taper par ex:  
 DB::table('users')->insert([
'name' => 'Okan',
'email' => 'okan.sener@hotmail.com',
'password' => bcrypt('kingdomhearts'),
]);

voir https://laravel.com/docs/5.6/seeding#writing-seeders

 - Puis taper `php artisan migrate:fresh` et ensuite un `php artisan db:seed` pour rafraîchir et seeder les nouvelles données.


##### Mon user sera crée dans le fichier "users" de ma base de donnée "lastchance". 





## Création d'un onglet et d'une page dans l'AdminLTE

  On va dans le dossier config-->adminlte puis aller dans le menu de "main navigation" et ajouter un onglet que l'on souhaite. FAIRE ATTENTION A BIEN CHANGER L'URL  du nouvel onglet dans le main navigation

 - Puis on va dans le dossier "views" et créer un dossier "admin" dans lequel on va créer un dossier "post" et y créer un "index.blade.php"
 - Puis on va copier le contenu du "home.blade.php" dans "index.blade.php" et créer la structure que l'on voudra voir sur notre page AdminLTE


 - Puis taper  `Route::resource('/admin/post', 'PostController');`  dans le web.php  pour créer une route qui va aller récupérer les données du PostController
Le "resource" va permettre, contrairement au "get" de récupérer la function que l'on veut sans devoir la cibler dans le chemin de la route, voir ci-dessus.


 - Puis dans l'index du PostController.php on va taper `return  view('admin.post.index')` pour renvoyer la view qui va récupérer le contenu de "index.blade.php"


 - Puis taper `Post::all();` pour récupérer toutes les tables du Post






### Retranscrire ce qu'il y'a dans la base de donnée dans l'AdminLTE

Dans la function "index" PostController --> 
$posts=Post::all();
return  view('admin.post.index',compact('posts'));

On crée une variable `$posts` qui va contenir le `Post::all();`, ceci va appeler toutes les tables post de la base de donnée.

Ensuite dans "index.blade.php", dans le section content on tapera ( voir index.blade.php ).
On va créer un @foreach où on va appeler la variable "$posts" qui va agir sur chaque 'element'.

Ensuite on fera un `{{$loop->iteration}}` ce qui permettra de créer une chaîne du même nombre que dans le PostTableSeeder qui renvoi vers le phpMyAdmin

Ensuite on tapera `{{$element->titre}}` pour appeler les titres, qui sont au nombre de 10 dans ce cas, qui sont dans la base de donnée "post" de "lastchance" via le paramètre "element".






#### Via les boutons, afficher du contenu avec dans ce cas-ci, des boutons "edit" et "delete"

Dans la function "show" du "PostController", on tape 

    return  view ('admin.post.show', compact('post'));



 - Ensuite, on créera un bouton dans chacun des post dans l'index.blade.php  via le foreach que l'on a crée et on tapera ceci :
<a  class="btn btn-primary"  href="{{route('post.show',['post'=>$element->id])}}">show</a>



 - Ensuite, dans le show.blade.php que l'on crée dans le dossier "post" qui est dans le dossier "admin", on aura 
 ( voir show.blade.php ).



##### Quand on clique sur le bouton "show" d'un post

 

 - On va optimiser le bouton "edit" d'un post suite au bouton show d'un post dans l'AdminLTE.


###### edit 

 - Dans la function "edit" du "PostController", on tape :
return  view ('admin.post.edit', compact('post'));

  
 - voir "edit.blade.php" et PostController

###### update 

 - Dans le function "update" du PostController, on tape :

$post->titre = $request ->titre;
$post->contenu = $request ->contenu;
$post -> save();
return  redirect()-> route ('post.index');

 - Toujours dans le PostController, dasn le function "update" pour mettre des conditions au cas où le titre ou la zone de texte sont vides, on tape juste au-dessus de ce qu'on a écrit avant :


$request->validate([
'titre' => 'required|unique:posts|max:255',
'contenu' => 'required',]);





 - Et dans "edit.blade.php" , au début du code du formulaire, on va taper :

```php
@if($errors->has('titre'))

<div  class="text-danger">Titre obligatoire</div>

@endif
```

 - Et dans mon input, on mettra un "old" : 
 value="{{old('titre',$post->titre)}}


###### create

 - On copie ce qu'il y'a dans "edit.blade.php" dans un "create.blade.php" que l'on crée dans le dossier "post" du dossier "admin"

 - Ensuite on enlève la méthode "PUT" puis on change la route du "form" en : 
action="{{route('post.store')}}"

 - Ensuite dans la function "creat" du PostController on tape :
return  view ('admin.post.create');

 - Ensuite dans la function "store" du PostController on tape la même chose que dans la function "update"  et on y rajoute `$post = new  Post;`  avant tous les $post.

#### Créer ses requêtes

 1. ON a créer une requête que l'on va nommer StorePost avec : php artisan make:request StorePost
 2. On crée des rules dans le fichier
 3. On a changé la autorize en "true"
 4. Dans le PostController , on appel notre StorePort dans la function et on l'appel avec un "use" tout au-dessus suivi du même namespace qu'il y'a sur le StorePost suivi d'un 
 5. Changer le `$request->validate` en `$request->validated()` et enlever les données qui suit
 






## Comment, en créant des nouveaux posts, les lier avec notre user 

 - Dans le fichier migration des "posts", c-à-d --> 2018_05_23_132852_create_posts_table

on crée une $table user_id --> 
$table->unsignedInteger('user_id');

puis une $table de liaison -->
$table->foreign('user_id')->references('id')->on('users');

 -  La $table "user_id" que l'on a crée dans le fichier de migration des "posts" va se référencer à la 
 $table->increments('id'); qui se trouve dans le fichier de migration "users".


#### Appelez l'user et les posts dans les model User et Post

 - Dans "User.php" --> créer la function -- > 
 public  function  posts(){
      return  $this ->hasMany('App\Post')};
 - Dans "Post.php --> créer le function --> 
 public  function  user(){
       return  $this->belongsTo('App\User')};


 - Puis faire un php artisan migrate:fresh


#### Appeler le "UserFactory" dans le "UserTableSeeder"

 - On va taper :
 factory(App\User::class, 10) ->create()
->each(function ($user){$user->posts()->save(factory(App\Post::class)->make());
});



 Cela va appeler la production de la factory du user dans le "UserTableSeeder" et cela va permettre à l'user de créer plusieurs posts

Du coup, dans le DatabaseSeeder, on va enlever la commande `$this->call(PostTableSeeder::class);`car maintenant, le UserTableSeeder va gérer la création des posts du PostTableSeeder.


#### Créer une colonne "Auteur" dans l'AdminLTE

 - Dans "index.blade.php", dans le foreach, on va taper :
<td>{{$element->user->name}}</td>

Cela va générer, pour chaque post, un auteur.
 


### Créer un post avec l'user lié aux posts

 - Dans le "create.blade.php", on créer un input :

    <input  type="hidden"  name="user_id"  value="{{Auth::user()->id}}">


Dans la value de l'input, on authentifie avec un `{{Auth::` qui va permettre d'aller chercher la valeur de l'user avec un son id sinon on ne peut pas créer un nouveau "post".

 - Ensuite on doit aller dans le PostController pour que ça le renvoi et dans la méthode "store", on rajoute `$post->user_id = $request->user_id;` et juste au-dessus dans les $request->validate, on va ajouter `'user_id' => 'required|numeric'`.
  Ces commandes sont nécessaires pour que le PostController reconnaisse la valeur de l'input dans le "create.blade.php" et la requête est là pour l'autoriser.

## Les Policies, qui vont permettre de sécuriser nos posts et donc d'empêcher le fait d'éditer ou de supprimer le post

On tape `php artisan make:policy PostPolicy --model=Post`et cela créera un fichier PostPolicy

 - On rajoute `use App\Policies\PostPolicy;` dans le fichier PostPolicy
 - Dans protected $policies, on ajoute `"App\Post"=>"App\Policies\PostPolicy"`



Ensuite dans PostPolicy, on rajoute  `return  $user->id === $post->user_id;` dans la function "update" 



Ensuite dans PostController, on ajoute `$this->authorize('update', $post);` dans la function "update" juste au-dessus des $request->validate




Et finalement, on entoure le bouton avec un @can comme ceci:

@can('update',$post)
<a  href="{{route('post.edit',['post'=>$post->id])}}"  class="btn btn-warning">edit</a>
@endcan


### Le Destroy, qui va permettre de supprimer un post

 - Dans le PostController, dans le function "destroy", on va taper ⇒ 
$post->delete();
return  redirect()->route('post.index');


 - Dans le "show.blade.php", on créera un bouton delete 
  => <form  class="d-inline"  action="{{route('post.destroy', ['post'=>$post->id])}}"  method="POST">

<button  type="submit"  class="btn btn-danger">delete</button>



##### Autorize du delete et le masquer 

 - Dans la function "destroy" du PostController, on va rajouter `$this->authorize('delete', $post);` 

 - Ensuite , on va entourer le "form" et le bouton "delete" avec `@can('delete',$post)
 @endcan`




## Les autorize et middleware




##  Upload des fichiers/images dans nos posts


##### Ajout de la $table dans le fichier de migration

Dans le fichier migration, rajouter une `$table->string('image')->nullable()`. Ceci va permettre de créer un nouveau tableau pour mettre une image dans le post


##### Créer l'input dans le create.blade.php

Ensuite dans le create.blade.php, rajouter un "file browser" de bootstrap pour choisir une image et copier coller ça au-dessus du bouton "créer". ( VOIR CREATE.BLADE.PHP)
 Ceci créera un label lié avec un input pour aller chercher une image dans nos fichiers. Changer le nom  du name de l'id  et du for du label et de l'input avec "image" pour que cela soit reconnu dans le PostController
Ensuite dans le "form action" avec la route store du fichier "create.blade.php", il faut rajouter un enctype avec un multipart/form-data


##### Appeler l'image dans le PostController pour qu'il le reconnaisse

Ensuite dans le PostController, on va dans le function "store",  taper `$post->image = $request->image->store('','imagePost');`



##### Création d'un "disk" dans le FILESYSTEM.PHP pour rendre l'image publique

Ensuite dans le "filesystem.php", on a créer notre propre "disk" qu'on va appeler "imagePost" ( en copiant le même contenu que celui du public ) et ajouter `('app/public/image-post)` dans le root et `/storage/image-post` dans l'url. Ensuite on termine par un `php artisan storage:link` cela va permettre de linker notre "disk" avec le fichier "public" du storage.


##### On va chercher l'image dans le storage  où l'on a créer notre propre "disk" que l'on nommé "imagePost", puis chercher les données de la $table que l'on a créer dans le fichier de migration

Ensuite dans le "show.blade.php" au-dessus du `<p>{{$post->contenu}}</p>` , on va taper `<p>  <img class="img-fluid"  src="{{ Storage::disk('imagePost')->url($post->image)"  alt=""></p>.` 


##### Validation de la règle de la taille de l'image via le StorePost ou directement dans la function "store" du PostController
Ensuite dans le StorePost que l'on avait potentiellement crée, qui est un fichier avec un ensemble de règles/validations OU dans les $request de la function "store" du PostController on va taper `"image"=> "image|size:100"`



##### On va transmettre les mêmes commandes de codes du "create.blade.php" vers le "edit.blade.php"
Dans "edit.blade.php", on copie-colle le enctype,  le message d'erreur et le label+input du "create.blade.php"
+ `<p><img  class="img-fluid"  src="{{Storage::disk('imagePost')->url($post->image)}}"  alt=""></p>` en-dessous de cela.

##### update de l'image d'un post dans un post

Rajouter `"image"=> "image|max:400000|mimes:jpeg,bmp,png,jpg"`  dans le StorePost que l'on avait potentiellement crée, qui est un fichier avec un ensemble de règles/validations OU dans les $request de la function "update" du PostController


Puis, rajouter  (voir  juste en-dessous ) pour voir le code qui va permettre de remplacer une image par une autre dans la function "update" du PostController. 
Cela va permettre de supprimer l'image qu'on a remplacé du storage pour ne pas alourdir le site et donc la remplacer par une nouvelle image.


##### Appel du Storage et donc de notre "disk" dans le PostController
Ensuite mettre un "use Storage" tout au-dessus dans le PostController.


##### Pour changer les dimensions d'une photo en la postant
Pour changer les dimensions, la couleurs, ajouter du texte sur une photo que l'on enregistre pour le site, on utilise Intervention. 
Pour installer `composer require intervention\image` -> disponible dans la doc. Depuis Laravel 5.5, on ne doit plus intégrer Intervention dans les providers de notre projet (fichier app.php dans les configs).

Un service dans Laravel, c'est un outil qui va servir à quelque chose de bien spécifique.
    
Quand on utilisera le resize, on créera un second disque que l'on appelle "thumbnails" par exemple dans lequel on stockera les images avec leurs nouvelles dimensions et le premier disque servira à conserver l'image originale.

