<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use App\Http\Resources\Poll as PollResource;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Requests\StorePoll;
use App\Models\Answer;

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

    public function pollsPerUser($id)
    {
        $answers = Answer::where('user_id', $id)->get();

        $polls = [];

        foreach (@$answers as $item) {
            $polls[] = $item->questions->polls;
        }

        //array_unique elimina los datos duplicados del array
        //array_values resetea los keys de los elementos en el array
        @$uniPoll = array_values(array_unique($polls));
        return $this->sendResponse($uniPoll);
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
