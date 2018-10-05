<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Misc\Skill;
use App\Http\Resources\SkillResource;
use App\Http\Resources\SkillCollection;
use Validator;

class SkillController extends Controller {

    /**
     * @OAS\Post(
     *     path="skill/read",
     *     tags={"Misc"},
     *     summary="List of Skill",
     *     @OAS\Response(
     *         response=200,
     *         description="Ok",
     *         @OAS\JsonContent(
     *             type="array",
     *             @OAS\Items(ref="#/../../Models/Misc/Skill")
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
            $skill = Skill::whereId($request->id)->first();
            return new SkillResource($skill);
        }
        elseif(isset($request->items)) {
            $skill = Skill::paginate($request->items);
            return new SkillCollection($skill);
        }
        else {
            $skill = Skill::get();
            return SkillCollection::collection($skill);
        }
    }

    /**
     * @OAS\Post(
     *     path="skill/create",
     *     tags={"Skill"},
     *     summary="Create a Skill",
     *     @OAS\Response(
     *         response=405,
     *         description="Invalid input"
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
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        
        $skill = new Skill();
        $skill->name = $request->name;
        $skill->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="skill/update",
     *     tags={"Skill"},
     *     summary="Update a Skill",
     *     @OAS\Response(
     *         response=405,
     *         description="Invalid input"
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
    public function update(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $skill = Skill::find($request->id);
        $skill->name = $request->name;
        $skill->save();
        
        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="skill/delete",
     *     tags={"Skill"},
     *     summary="Delete a Skill",
     *     @OAS\Response(
     *         response=405,
     *         description="Invalid input"
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
    public function delete(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $skill = Skill::find($request->id);
        $skill->delete();
        
        return response()->json([
            'status' => 'ok'
        ]);
    }

}

?>