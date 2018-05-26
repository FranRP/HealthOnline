<?php

namespace App\Http\Controllers;

use DB;
use App\Message;
use Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\CreateMessageRequest;
use App\Events\MessageWasReceived;


class MessagesController extends Controller
{

    function __construct()
    {
        $this->middleware('auth', ['except' => ['create','store']]);
        $this->middleware('roles:admin',['except' => ['create','store']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        // $messages = DB::table('messages')->get();

        $key = "messages.page." . request('page', 1);

        if (Cache::has($key))
        {
            $messages = Cache::get($key);
        }
        else
        {
            $messages = Message::with(['user','tags'])
            ->orderBy('created_at', request('sorted', 'DESC'))
            ->paginate(7);

             Cache::put($key, $messages, 5);
        }

        

        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Guardar mensaje
       /* DB::table('messages')->insert([
            "nombre" => $request->input('nombre'),
            "correo" => $request->input('correo'),
            "mensaje" => $request->input('mensaje'),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);*/

        /*
        $message = new Message;
        $message->nombre = $request->input('nombre');
        $message->correo = $request->input('correo');
        $message->mensaje = $request->input('mensaje');
        $message->save();
        */

        

        if (auth()->check()) 
        {
            $message = new Message;
            $message->name = auth()->user()->name;
            $message->email = auth()->user()->email;
            $message->mensaje = $request->input('mensaje');
            auth()->user()->messages()->save($message);
        } else {
            $message = Message::create($request->all());
        }

        Cache::flush();


        event(new MessageWasReceived($message));

        

        //Redireccionar
            return redirect()->route('mensajes.create')->with('info','Hemos recibido tu mensaje');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
        //$message = DB::table('messages')->where('id', $id)->first();
        $message = Message::findOrFail($id);

        return view("messages.show", compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        //$message = DB::table('messages')->where('id', $id)->first();

        $message = Message::findOrFail($id);

        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Actualizamos

        /*DB::table('messages')->where('id',$id)->update([
            "nombre" => $request->input('nombre'),
            "correo" => $request->input('correo'),
            "mensaje" => $request->input('mensaje'),
            "updated_at" => Carbon::now(),
        ]);*/

        $message = Message::findOrFail($id);

        Cache::flush();

        $message->update($request->all());

        //Redireccionamos
        return redirect()->route('mensajes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Eliminar mensaje

        Message::findOrFail($id)->delete();

        Cache::flush();

        //DB::table('messages')->where('id',$id)->delete();
        //Redireccionar
        return redirect()->route('mensajes.index');
    }
}
