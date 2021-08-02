<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use App\Http\Resources\Poll as PollResource;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Requests\StoreFullPoll;
use App\Http\Requests\StorePoll;
use App\Models\Answer;
use App\Models\Question;

use function PHPUnit\Framework\isEmpty;

class PollController extends BaseController
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePoll $request)
    {
        $poll = Poll::create($request->all());

        if($poll){
            return $this->sendResponse($poll);
        }
        else{
            return $this->sendError('No se pudo crear la encuesta', 400);
        }
    }

    //Almacena una encuesta con sus respectivas preguntas
    public function storeFullPoll(StoreFullPoll $request)
    {
        do {
            $poll_code = rand(1, 9999999);
        } while (Poll::find($poll_code) != null);

        $poll = new Poll();

        $poll->id = $poll_code;
        $poll->user_id = $request->user_id;
        $poll->poll_reason = $request->poll_reason;
        $poll->poll_subtitle = $request->poll_subtitle;
        $poll->expected_samplings = $request->expected_samplings;
        $poll->total_samplings = $request->total_samplings;
        $poll->active = 1;

        $poll->save();
        
        return $this->sendResponse($poll);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $poll = Poll::findOrFail($id);
        
        return $this->sendResponse($poll, $poll->users, $poll->questions);
        
        // return $this->sendResponse(new PollResource($poll::with(['users', 'questions'])->first()));
    }

    //Regresa las encuestas en las que ha participado el usuario
    public function pollsPerUser($id)
    {
        $answers = Answer::where('user_id', $id)->has('questions')->distinct()->get();

        $polls = [];

        foreach (@$answers as $answer) {
            $polls[] = $answer->questions->polls;
        }

        //array_unique elimina los datos duplicados del array
        //array_values resetea los keys de los elementos en el array
        @$uniPoll = array_values(array_unique($polls));
        return $this->sendResponse($uniPoll);
    }

    //Recibe el Id de la encuesta y devuelve todas las preguntas relacionadas a ella
    public function showPerPoll($id)
    {
        $poll = Poll::findOrFail($id);

        return $this->sendResponse($poll->questions, $poll->questions->options);
    }

    //Regresa las encuestas del search
    public function searchPoll($query)
    {
        $polls = Poll::where('id', 'like', '%' . $query . '%')->where('active', 1)->get();
        $current = array();

        if($polls->count() >= 10) {

            $i = 0;
            foreach ($polls as $item) {
                $i++;

                if($i > 10){
                    break;
                }

                array_push($current, $item);
            }

            return $this->sendResponse($current);
        }

        return $this->sendResponse($polls);
        
        // return $this->sendResponse(new PollResource($poll::with(['users', 'questions'])->first()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        //
    }
}
