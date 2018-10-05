<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoleResource;

/**
 * @OAS\Schema(
 *     title="Company",
 *     @OAS\Xml(
 *         name="Company"
 *     )
 * )
 */

class CompanyResource extends JsonResource
{
    /**
     * @OAS\Property(property="id",type="integer")
     * @OAS\Property(property="name",type="string")
     * @OAS\Property(property="about_us",type="string")
     * @OAS\Property(property="founding",type="integer")
     * @OAS\Property(property="size",type="string")
     * @OAS\Property(property="xing",type="string")
     * @OAS\Property(property="website",type="string")
     * @OAS\Property(property="linkedin",type="string")
     * @OAS\Property(property="youtube",type="string")
     * @OAS\Property(property="twitter",type="string")
     * @OAS\Property(property="telephone",type="string")
     * @OAS\Property(property="roles",ref="#components/schemas/RoleResource")
     *
     * @return array
     */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'about_us' => $this->about_us,
            'founding' => $this->founding,
            'size' => $this->size,
            'xing' => $this->xing,
            'website' => $this->website,
            'linkedin' => $this->linkedin,
            'youtube' => $this->youtube,
            'twitter' => $this->twitter,
            'telephone' => $this->telephone,
            'roles' => RoleResource::collection($this->whenLoaded('roles'))
        ];
    }
}
