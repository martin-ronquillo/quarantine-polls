<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestion;
use App\Models\Poll;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    function containsOnlyNull($array) {
        return array_reduce($array, function (bool $boolean, $value) {  
            return !$boolean ? $boolean : $value !== null; 
        }, true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestion $request)
    {
        // dd(array_search(null,$request->options,true));
        if($request->type == 'Multi Checker') {
            if($this->containsOnlyNull($request->options) && count($request->options) >= 2) {
                // dd($request->options);
                $question = Question::create([
                    'poll_id' => $request->poll_id, 
                    'question' => $request->question,
                    'type' => $request->type,
                    'required' => $request->required,
                ]);
                return $this->sendResponse($question);
            }
        } elseif($request->type != 'Multi Checker') {
            $question = Question::create([
                'poll_id' => $request->poll_id, 
                'question' => $request->question,
                'type' => $request->type,
                'required' => $request->required,
            ]);
            return $this->sendResponse($question);
        }
        
        return $this->sendError('No se pudo crear la pregunta', Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::findOrFail($id);

        return $this->sendResponse($question, $question->polls, $question->options);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestion $request, $id)
    {
        $question = Question::findOrFail($id);

        $question->question = $request->question;
        $question->type = $request->type;
        $question->required = $request->required;

        $question->save();
        
        return $this->sendResponse($question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
