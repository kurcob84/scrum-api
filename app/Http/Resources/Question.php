<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OAS\Schema(
 *     title="Questions",
 *     @OAS\Xml(
 *         name="Questions"
 *     )
 * )
 */

class Question extends JsonResource
{
    /**
     * @OAS\Property()
     * @var string
     */
    private $question;

    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'question'  => $this->question,
            'answers'   => AnswerResource::collection($this->whenLoaded('answer'))
        ];
    }
}