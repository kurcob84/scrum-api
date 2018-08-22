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

class Answer extends JsonResource
{
    /**
     * @OAS\Property()
     * @var string
     */
    private $answer;

    /**
     * @OAS\Property()
     * @var bool
     */
    private $correct;

    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'answer'        => $this->answer,
            'correct'       => $this->correct
        ];
    }
}
