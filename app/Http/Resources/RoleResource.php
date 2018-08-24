<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OAS\Schema(
 *     title="Role",
 *     @OAS\Xml(
 *         name="Role"
 *     )
 * )
 */

class RoleResource extends JsonResource
{
    /**
     * @OAS\Property(property="id",type="integer")
     * @OAS\Property(property="name",type="string")
     *
     * @return array
     */

    public function toArray($request) 
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name
        ];
    }
}
