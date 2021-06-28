<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Poll as PollResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          =>  $this->id,
            'ci'          =>  $this->ci,
            'name'        =>  $this->name,
            'last_name'   =>  $this->las_name,
            'email'       =>  $this->email,
            'polls'       =>  PollResource::collection($this->polls),
            // 'api_token'   =>  $this->api_token,
            // 'password'    =>  $this->password,
        ];
    }
}
