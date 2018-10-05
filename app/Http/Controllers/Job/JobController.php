<?php

namespace App\Http\Controllers\Job;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job\Job;
use App\Http\Resources\JobResource;
use App\Http\Resources\JobCollection;
use Validator;

class JobController extends Controller {

    /**
     * @OAS\Post(
     *     path="job/read",
     *     tags={"Job"},
     *     summary="List of Job",
     *     @OAS\Response(
     *         response=200,
     *         description="Ok",
     *         @OAS\JsonContent(
     *             type="array",
     *             @OAS\Items(ref="#/../../Models/Job/Job")
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
            $job = Job::with('company')->whereId($request->id)->first();
            return new JobResource($job);
        }
        elseif(isset($request->items)) {
            $job = Job::with('company')->paginate($request->items);
            return new JobCollection($job);
        }
        else {
            $job = Job::with('company')->get();
            return JobCollection::collection($job);
        }
    }

    /**
     * @OAS\Post(
     *     path="job/create",
     *     tags={"Job"},
     *     summary="Create a Job",
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
            'company_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'salary' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        
        $job = new Job();
        $job->company_id = $request->company_id;
        $job->title = $request->title;
        $job->description = $request->description;
        $job->salary = $request->salary;
        $job->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="job/update",
     *     tags={"Job"},
     *     summary="Update a Job",
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

        $job = Job::find($request->id);
        $input = $request->all();
        $job->fill($input)->save();
        
        return response()->json([
            'status' => 'ok'
        ]);
    }    
    
    /**
    * @OAS\Post(
    *     path="job/delete",
    *     tags={"Job"},
    *     summary="Delete a Job",
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
       $job = Job::find($request->id);
       $job->delete();
       
       return response()->json([
           'status' => 'ok'
       ]);
   }

}

?>