<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * @OAS\Schema(
     *     title="Role",
     *     @OAS\Xml(
     *         name="Role"
     *     )
     * )
     */
    public function toArray($request) 
    {
            return [
                'id'            => $this->id,
                'name'          => $this->name
            ];
    }
}
