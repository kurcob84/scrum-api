<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoleResource;

/**
 * @OAS\Schema(
 *     title="Applicant",
 *     @OAS\Xml(
 *         name="Applicant"
 *     )
 * )
 */

class ApplicantResource extends JsonResource
{
    /**
     * @OAS\Property(property="id",type="integer")
     * @OAS\Property(property="salutation",type="integer")
     * @OAS\Property(property="salary",type="integer")
     * @OAS\Property(property="new_job",type="integer")
     * @OAS\Property(property="roles",ref="#components/schemas/RoleResource")
     * @OAS\Property(property="email",type="string")
     * @OAS\Property(property="firstname",type="string")
     * @OAS\Property(property="lastname",type="string")
     * @OAS\Property(property="birthday",type="string")
     * @OAS\Property(property="city",type="string")
     * @OAS\Property(property="description",type="string")
     * @OAS\Property(property="telephone",type="string")
     * @OAS\Property(property="skype",type="string")
     * @OAS\Property(property="language",type="string")
     * @OAS\Property(property="periodofnotice",type="string")
     * @OAS\Property(property="github",type="string")
     * @OAS\Property(property="linkedin",type="string")
     * @OAS\Property(property="xing",type="string")
     *
     * @return array
     */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'salutation' => $this->salutation,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'birthday' => $this->birthday,
            'city' => $this->city,
            'description' => $this->description,
            'telephone' => $this->telephone,
            'skype' => $this->skype,
            'salary' => $this->skype,
            'language' => $this->language,
            'new_job' => $this->new_job,
            'periodofnotice' => $this->periodofnotice,
            'github' => $this->github,
            'linkedin' => $this->linkedin,
            'xing' => $this->xing,
            'roles' => RoleResource::collection($this->whenLoaded('roles'))
        ];
    }
}
