<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\Answers;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionCollection;

/**
 * Class Pet
 *
 * @package App\Http\Controllers
 */

class QuestionsController extends Controller
{
    /**
     * @OAS\Post(
     *     path="questions/read",
     *     tags={"Questions"},
     *     summary="List of questions and answers",
     *     @OAS\Response(
     *         response=200,
     *         description="Ok",
     *         @OAS\JsonContent(
     *             type="array",
     *             @OAS\Items(ref="#/../../Models/Answers")
     *         )
     *     ),
     *     @OAS\Parameter(
     *         name="Authorization",
     *         in="query",
     *         description="JWT access token.",
     *         required=true,
     *         @OAS\Schema(
     *             type="header",
     *         )
     *     ),
     * )
     */
    public function read(Request $request) {
        if($request->id != null) {
            $questions = new QuestionResource(Questions::with('answers')->whereId($request->id)->first());
        }
        elseif(isset($request->items)) {

            $t = Questions::with('answers')->paginate(($request->items));
            $questions = new QuestionCollection($t);

            // $questions = new QuestionCollection();
        }
        else {
            $questions = QuestionResource::collection(Questions::with('answers')->get());
        }

        return response()->json([
            'status' => 'ok',
            'data' => $questions
        ]);
    }

    /**
     * @OAS\Post(
     *     path="questions/create",
     *     tags={"Questions"},
     *     summary="Create a question with answers",
     *     @OAS\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     * )
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'question' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        
        $Questions = new Questions();
        $Questions->question = $request->question;
        $bQuestions = $Questions->save();

        foreach($ans as $request->answers) {
            $Answers = new Answers();
            $Answers->answer = $ans->answers;
            $Answers->correct = $ans->correct;
            $Answers->questions_id = $Questions->id;
            $Answers->save();
        }

        return response()->json([
            'status' => 'ok',
            'data' => $bQuestions
        ]);
    }

    /**
     * @OAS\Post(
     *     path="questions/delete",
     *     tags={"Questions"},
     *     summary="Delete a question",
     *     @OAS\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     * )
     */
    public function delete(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $Questions = Questions::find($request->id);
        $bQuestions = $Questions->delete();
        
        return response()->json([
            'status' => 'ok',
            'data' => $bQuestions
        ]);
    }
}