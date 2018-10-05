<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Misc\Position;
use App\Http\Resources\PositionResource;
use App\Http\Resources\PositionCollection;
use Validator;

class PositionController extends Controller {

    /**
     * @OAS\Post(
     *     path="position/read",
     *     tags={"Misc"},
     *     summary="List of Position",
     *     @OAS\Response(
     *         response=200,
     *         description="Ok",
     *         @OAS\JsonContent(
     *             type="array",
     *             @OAS\Items(ref="#/../../Models/Misc/Position")
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
            $position = Position::whereId($request->id)->first();
            return new PositionResource($position);
        }
        elseif(isset($request->items)) {
            $position = Position::paginate($request->items);
            return new PositionCollection($position);
        }
        else {
            $position = Position::get();
            return PositionCollection::collection($position);
        }
    }

    /**
     * @OAS\Post(
     *     path="position/create",
     *     tags={"Position"},
     *     summary="Create a Position",
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
        
        $position = new Position();
        $position->name = $request->name;
        $position->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="position/update",
     *     tags={"Position"},
     *     summary="Update a Position",
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

        $position = Position::find($request->id);
        $position->name = $request->name;
        $position->save();
        
        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="position/delete",
     *     tags={"Position"},
     *     summary="Delete a Position",
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
        $position = Position::find($request->id);
        $position->delete();
        
        return response()->json([
            'status' => 'ok'
        ]);
    }

}

?>