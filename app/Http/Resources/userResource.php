<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class userResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name'          => $this->name,
            'email'         => $this->email,
            'username'      => $this->user_name,
            'avatar'        => is_null($this->avatar) ? null : $this->image,
            'registered_at' => $this->registered_at
        ];
    }
    
}
