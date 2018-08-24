<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OAS\Schema(
 *     title="Answers",
 *     @OAS\Xml(
 *         name="Answers"
 *     )
 * )
 */

class AnswerResource extends JsonResource
{
    /**
     * @OAS\Property(property="id",type="integer")
     * @OAS\Property(property="answer",type="string")
     * @OAS\Property(property="correct",type="boolean")
     *
     * @return array
     */

    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'answer'        => $this->answer,
            'correct'       => $this->correct
        ];
    }
}
