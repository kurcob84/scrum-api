<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\JobResource;
use App\Http\Resources\ApplicantResource;

/**
 * @OAS\Schema(
 *     title="ApplicantionJob",
 *     @OAS\Xml(
 *         name="ApplicantionJob"
 *     )
 * )
 */

class ApplicantionJobResource extends JsonResource
{
    /**
     * @OAS\Property(property="id",type="integer")
     * @OAS\Property(property="job",ref="#components/schemas/JobResource")
     * @OAS\Property(property="applicant",ref="#components/schemas/ApplicantResource")
     * @OAS\Property(property="application",type="string")
     *
     * @return array
     */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'job' => JobResource::collection($this->whenLoaded('job')),
            'applicant' => ApplicantResource::collection($this->whenLoaded('applicant')),
            'application' =>  $this->application
        ];
    }
}
