<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoleResource;

/**
 * @OAS\Schema(
 *     title="User",
 *     @OAS\Xml(
 *         name="User"
 *     )
 * )
 */

class UserResource extends JsonResource
{
    /**
     * @OAS\Property(property="id",type="integer")
     * @OAS\Property(property="firstname",type="string")
     * @OAS\Property(property="surname",type="string")
     * @OAS\Property(property="email",type="string")
     * @OAS\Property(property="language",type="string")
     * @OAS\Property(property="roles",ref="#components/schemas/RoleResource")
     *
     * @return array
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