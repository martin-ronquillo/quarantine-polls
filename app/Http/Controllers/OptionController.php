<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOption;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class OptionController extends BaseController
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
    public function store(StoreOption $request)
    {
        foreach($request->options as $option) {
            Option::create([
                'question_id' => $request->question_id,
                'option' => $option,
            ]);
        }

        return $this->sendResponse(Option::where('question_id', $request->question_id)->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->sendResponse(Option::where('question_id', $id)->get());
        // $option = Option::findOrFail($id);

        // return $this->sendResponse($option, $option->questions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        //
    }
}
