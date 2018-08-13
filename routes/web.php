<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//www.misitio.com = Route::get('/');
//www.misitio.com/contacto = Route::get('contacto',function() {});

//Route::get('/', function () {
 //   return view('welcome');
//});


/*Route::get('/',['as'=>'home',function() {
	return view('home');
	(echo "<a href=". route('contactos') .">Contacto</a><br>";
}]);*/

//Route::get('contactame', ['as' => 'contactos', 'uses' => 'PagesController@contact']);

DB::listen(function($query){
	//echo "<pre>{$query->sql}</pre>";
});

Route::get('prueba', function() {
	$prueba = \App\Inbox::with('user')->get();
	return $prueba;
	$prueba = \App\Report::with(['user','reportable'])->orderBy('created_at', request('sorted', 'DESC'))->get();
	return $prueba[0];
	$answer = \App\Answer::where('user_id',4)->select('question_id')->take(1)->with('question')->distinct()->get();
	return $answer;
	return \App\Report::with('reportable')->get();
	$prueba = \App\Inbox::where('destinatario',auth()->user()->name)->with('user')->first();
	return $prueba;
	$user = \App\User::findOrFail(1);
	return \App\Report::where('reportable_type','=',"App\Answer")->get();

	return \App\Answer::with('question')->get();

	return auth()->user()->roles->pluck('id')->intersect(3)->count();
	$prueba = \App\Question::all();
	return \App\Question::with('user')->get();
});




Route::get('/',['as'=>'home','uses' => 'PagesController@home']);


Route::get('saludos/{nombre?}', ['as'=>'saludos', 'uses' => 'PagesController@saludos'])->where('nombre',"[A-Za-z]+");

Route::resource('mensajes','MessagesController');
Route::resource('usuarios','UsersController');
Route::resource('reportes','ReportsController');
Route::resource('preguntas','QuestionsController');
Route::resource('respuestas', 'AnswerController');
Route::resource('correos','InboxesController');

Route::get('login','Auth\LoginController@showLoginForm');

Route::post('login','Auth\LoginController@login');

Route::get('logout', 'Auth\LoginController@logout');

Route::get('/preguntasAjax', function() {
	if (Request::ajax()){
		$questions = App\Question::all();
		return response()->json($questions);
	}
});

Route::get('/peticionScroll', 'QuestionsController@scroll');
Route::get('/recargaPreguntas', 'QuestionsController@recarga');
Route::get('/filtrarOrden', 'QuestionsController@filtrarOrden');
Route::get('/usuarios-profesionales','UsersController@listaProfesionales');
Route::post('/asignarLike', 'AnswerController@asignarLike');
Route::post('/reportarQuestion', 'QuestionsController@reportarQuestion');
Route::post('/reportarAnswer', 'AnswerController@reportarAnswer');


/*
Route::delete('usuarios/{usuario_id?}',function($usuario_id){
    $usuario = App\Users::destroy($usuario_id);
    return response()->json($usuario);
});
*/
/*

Route::post('contacto','PagesController@mensajes');

Route::get('mensajes', ['as' => 'messages.index', 'uses' => 'MessagesController@index']);

Route::get('mensajes/create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);

Route::post('mensajes', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);

Route::get('mensajes/{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);

Route::get('mensajes/{id}/edit', ['as' => 'messages.edit', 'uses' => 'MessagesController@edit']);

Route::put('mensajes/{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);

Route::delete('mensajes/{id}', ['as' => 'messages.destroy', 'uses' => 'MessagesController@destroy']);

*/



/*
Route::get('saludos/{nombre?}', ['as'=>'saludos',function($nombre = "Invitado") {
	$html = "<h2>Contenido html</h2>"; // Ingresado por formulario
	$script = "<script>alert('Problema XSS - Cross Site Scripting!')</script>"; // Ingresado por formulario
	//return view('saludo', ['nombre' => $nombre]);
	//return view('saludo')->with(['nombre' => $nombre]);
	$consolas = [
		"Play Station 4",
		"Xbox One"
	];

	return view ('saludo', compact('nombre','html', 'script','consolas'));
}])->where('nombre',"[A-Za-z]+");
*/

