<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoleResource;

class UserResource extends JsonResource
{
    /**
     * @OAS\Schema(
     *     title="User",
     *     @OAS\Xml(
     *         name="User"
     *     )
     * )
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'firstname'     => $this->firstname,
            'surname'       => $this->surname,
            'email'         => $this->email,
            'language'      => $this->language,
            'roles'         => RoleResource::collection($this->whenLoaded('roles'))
        ];
    }
}