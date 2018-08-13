<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\User;
use App\Like;

class AnswerController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
    {
        return null;
    }


    public function destroy($id)
    {
        $answer = Answer::findOrFail($id);
        $user = User::find($answer->user_id);

        if ($user)
        {
            $this->authorize('destroy',$user);
        }

        

        $answer->delete();

        

         return back()->with('info','Respuesta eliminada');
    }


    public function update(Request $request, $id)
    {
        $answer = Answer::findOrFail($id);
        $user = User::findOrFail($request->answer[0]);

        $this->authorize('edit',$user);

        $answer->body = $request->answer[1];
        $answer->save();


        return $answer->id;
    }



    public function reportarAnswer(Request $request)
    {
        $answer_id = $request->get("answerID");
        $answer = Answer::findOrFail($answer_id);
        $user = auth()->user();

        $reporte = $user->reports()->where([['reportable_id',$answer_id], ['reportable_type','App\Answer']])->first();

        if ($reporte)
        {
            return 'false';
        } else {
            $answer->reports()->create(['user_id'=>$user->id]);
            return 'true';
        }
        

    
    }


    public function store(Request $request)
    {

        //auth()->user()->id


        if (auth()->check()) 
        {
            $answer = new Answer;
	        $answer->body = $request->input('respuesta');
            $answer->user_id = auth()->user()->id;
            $answer->question_id = $request->input('questionId');
	        $answer->save();
	        return null;
        } else {
            return null;
        }

    }

    public function asignarLike(Request $request)
    {
        $answer_id = $request->get("answerID");
        $confirmed_like = $request->get("isLike");

        if ($confirmed_like == 'true') {
            $confirmed_like = true;
        } else {
            $confirmed_like = false;
        }

        $update = false;
        $answer = Answer::findOrFail($answer_id);

        if (!$answer) {
            return null;
        }

        $user = auth()->user();
        $like = $user->likes()->where('answer_id',$answer_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $confirmed_like) {
                if ($already_like == false) {
                    $answer->user->likes = $answer->user->likes + 1;
                } else {
                    $answer->user->likes = $answer->user->likes - 1;
                }
                $variableLike = $like->answer_id;
                $like->delete();
                $answer->user->save();
                return ['no-like',$variableLike];
            }
        } else {
            $like = new Like();
        }


        $like->like = $confirmed_like;
        $like->user_id = $user->id;
        $like->answer_id = $answer_id;

        if ($update === true) {
            $like->update();
            if ($like->like) {
                $answer->user->likes = $answer->user->likes + 2;
            } else {
                $answer->user->likes = $answer->user->likes - 2;
            }
            $answer->user->save();
            return ['actualiza', $like->like, $like->answer_id];
        } else {
            if ($like->like) {
                $answer->user->likes = $answer->user->likes + 1;
            } else {
                $answer->user->likes = $answer->user->likes - 1;
            }
            
            $answer->user->save();
            $like->save();
        }

        return ['nuevo', $like->like, $like->answer_id];
    }
}
