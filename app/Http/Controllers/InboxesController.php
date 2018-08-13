<?php

namespace App\Http\Controllers;

use App\Inbox;
use Illuminate\Http\Request;

class InboxesController extends Controller
{

	function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$recibidos = \App\Inbox::where('destinatario',auth()->user()->name)->with('user')->orderBy('created_at', request('sorted', 'DESC'))->paginate(5, ['*'], 'recibidos');
    	$enviados = \App\Inbox::where('user_id', auth()->user()->id)->orderBy('created_at', request('sorted', 'DESC'))->paginate(5, ['*'], 'enviados');
    	//$enviados = auth()->user()->inboxes;
        return view('inboxes.index',compact('recibidos','enviados'));
    }

    public function mensajePerfil(Request $request)
    {
        return 'hola';
    }


    public function store(Request $request)
    {
    	$authname = strtolower(auth()->user()->name);
    	$destname = strtolower($request->input('destinatario'));

    	if($authname == $destname) {
    		return 'same-nick';
    	}

    	$desti = \App\User::where('name', $request->input('destinatario'))->get();
    	if (count($desti) != 0) {
    		$inbox = new Inbox;
	        $inbox->body = $request->input('body');
	        $inbox->asunto = $request->input('asunto');
	        $inbox->destId = $desti[0]->id;
            $inbox->user_id = auth()->user()->id;
            $inbox->destinatario = $request->input('destinatario');
	        $inbox->save();
	        return ['true',$desti, $inbox];
    	} else {
    		return 'false';
    	}

    }
}
