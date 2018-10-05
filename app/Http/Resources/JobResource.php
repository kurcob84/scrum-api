<?php

namespace App\Http\Resources;
use App\Http\Resources\CompanyResource;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OAS\Schema(
 *     title="Job",
 *     @OAS\Xml(
 *         name="Job"
 *     )
 * )
 */

class JobResource extends JsonResource
{
    /**
     * @OAS\Property(property="id",type="integer")
     * @OAS\Property(property="title",type="string")
     * @OAS\Property(property="description",type="string")
     * @OAS\Property(property="salary",type="string")
     * @OAS\Property(property="company",ref="#components/schemas/CompanyResource")
     *
     * @return array
     */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->title,
            'salary' => $this->title,
            'copmany' => CompanyResource::collection($this->whenLoaded('company'))
        ];
    }
}
