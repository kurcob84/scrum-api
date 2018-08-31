<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AnswerResource;

/**
 * @OAS\Schema(
 *     title="Questions",
 *     @OAS\Xml(
 *         name="Questions"
 *     )
 * )
 */

class QuestionResource extends JsonResource
{
    /**
     * @OAS\Property(property="id",type="integer")
     * @OAS\Property(property="question",type="string")
     * @OAS\Property(property="answers",ref="#components/schemas/AnswerResource")
     *
     * @return array
     */

    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'question'  => $this->question,
            'answers'   => AnswerResource::collection($this->whenLoaded('answers'))
        ];
    }
}