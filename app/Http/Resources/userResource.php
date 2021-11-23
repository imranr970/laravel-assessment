<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class userResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'username'      => $this->username,
            'email'         => $this->email,
            'avatar'        => $this->image,
            'role'          => $this->role,
            'registered_at' => $this->registered_at
        ];
    }
    
}
