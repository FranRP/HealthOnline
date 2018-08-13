<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Like;
use App\User;
use App\Answer;


class QuestionsController extends Controller
{

    function __construct()
    {
        $this->middleware('auth', ['except' => ['show','index','filtrarOrden','scroll']]);
    }

    public function index()
    {
        $questions = Question::skip(0)->latest('id')->take(5)->get();
        return view('questions.index',compact('questions'));
    }

    public function edit($id) 
    {
        $question = Question::findOrFail($id);
        $question->status = 'cerrado';
        $question->save();

        return back();
    }


    public function store(Request $request)
    {

        //auth()->user()->id

        if (auth()->check()) 
        {
            $question = new Question;
	        $question->body = $request->input('pregunta');
            $question->title = $request->input('titulo');
	        auth()->user()->questions()->save($question);
        } else {
            $question = new Question;
	        $question->body = $request->input('pregunta');
	        $question->save();
        }

        return back();
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $user = User::find($question->user_id);

        if (!$user)
        {
            $question->delete();

        } else {

            $this->authorize('destroy',$user);

            $question->delete();
        }

        return redirect()->route('home');
    }


    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $user = User::findOrFail($request->question[0]);

        $this->authorize('edit',$user);

        $question->body = $request->question[1];
        $question->save();


        return 'Exito';
    }


    public function filtrarOrden(Request $request)
    {
        if($request->ajax())
        {
            $orden = $request->get("orden");
            if ($orden == 'desc') {
                $questions = Question::skip(0)->latest('id')->with('user')->take(5)->get();
            } else if ($orden == 'asc') {
                $questions = Question::skip(0)->oldest('id')->with('user')->take(5)->get();
            } else {
                return response()->json([
                    "response" => false
                ]
            );
            }
            

            if(count($questions) > 0)
            {
                return response()->json([
                        "response" => true,
                        "questions" => $questions
                    ]
                );
            }
 
            return response()->json([
                    "response" => false
                ]
            );
        }
    }

    public function recarga(Request $request)
    {
        if($request->ajax())
        {
            $firstId = $request->get("firstId");
            $questions = Question::where("id", ">", $firstId)->oldest('id')->with('user')->get();

            if(count($questions) > 0)
            {
                return response()->json([
                        "response" => true,
                        "questions" => $questions
                    ]
                );
            }
 
            return response()->json([
                    "response" => false
                ]
            );
        }

        abort(403);
    }


    public function reportarQuestion(Request $request)
    {
        $question_id = $request->get("questionID");
        $question = Question::findOrFail($question_id);
        $user = auth()->user();

        $reporte = $user->reports()->where([['reportable_id',$question_id], ['reportable_type','App\Question']])->first();

        if ($reporte)
        {
            return 'false';
        } else {
            $question->reports()->create(['user_id'=>$user->id]);
            return 'true';
        }
        

    
    }


    public function scroll(Request $request)
    {   

        if($request->ajax())
        {
            $lastId = $request->get("lastId");
            $orden = $request->get("orden");
 
            if ($orden == 'desc') {
                $questions = Question::where("id", "<", $lastId)->latest('id')->take(2)->with('user')->get();
            } else if ($orden == 'asc'){
                $questions = Question::where("id", ">", $lastId)->oldest('id')->take(2)->with('user')->get();
            } else {
                return response()->json(["response" => false]);
            }
            
        
            if(count($questions) > 0)
            {
                return response()->json([
                        "response" => true,
                        "questions" => $questions
                    ]
                );
            }
 
            return response()->json([
                    "response" => false
                ]
            );
        }
 
        abort(403);
    }


    public function show($id)
    {
        $question = Question::findOrFail($id);

        $answers = Answer::where("question_id", $id)->orderBy('created_at', request('sorted', 'DESC'))->paginate(5);

        return view('questions.show', compact('question','answers'));
    }



}
