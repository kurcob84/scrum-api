<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job\Jobtype;
use App\Http\Resources\JobtypeResource;
use App\Http\Resources\JobtypeCollection;
use Validator;

class JobtypeController extends Controller
{

    /**
     * @OAS\Post(
     *     path="jobtype/read",
     *     tags={"Jobtype"},
     *     summary="List of Jobtype",
     *     @OAS\Response(
     *         response=200,
     *         description="Ok",
     *         @OAS\JsonContent(
     *             type="array",
     *             @OAS\Items(ref="#/../../Models/Job/Jobtype")
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
    public function read(Request $request)
    {
        if ($request->id != null) {
            $jobtype = Jobtype::with('company')->whereId($request->id)->first();
            return new JobtypeResource($jobtype);
        } elseif (isset($request->items)) {
            $jobtype = Jobtype::with('company')->paginate($request->items);
            return new JobtypeCollection($jobtype);
        } else {
            $jobtype = Jobtype::with('company')->get();
            return JobtypeCollection::collection($jobtype);
        }
    }

    /**
     * @OAS\Post(
     *     path="jobtype/create",
     *     tags={"Jobtype"},
     *     summary="Create a Jobtype",
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
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $jobtype = new Jobtype();
        $jobtype->name = $request->name;
        $jobtype->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="jobtype/update",
     *     tags={"Jobtype"},
     *     summary="Update a Jobtype",
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
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $jobtype = Jobtype::find($request->id);
        $input = $request->all();
        $jobtype->fill($input)->save();
        
        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
    * @OAS\Post(
    *     path="jobtype/delete",
    *     tags={"Jobtype"},
    *     summary="Delete a Jobtype",
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
    $jobtype = Jobtype::find($request->id);
    $jobtype->delete();
    
    return response()->json([
        'status' => 'ok'
    ]);
}

}

?>