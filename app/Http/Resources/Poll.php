<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Question as QuestionResource;
use App\Http\Resources\User as UserResource;

class Poll extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'        =>  $this->id,
            'samplings' =>  $this->samplings,
            'user'      =>  new UserResource($this->whenLoaded('users')),
            'questions' =>  QuestionResource::collection($this->whenLoaded('questions')),
        ];
    }
}