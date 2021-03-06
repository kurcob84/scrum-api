<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OAS\Schema(
 *     title="Jobtype",
 *     @OAS\Xml(
 *         name="Jobtype"
 *     )
 * )
 */

class JobtypeResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
