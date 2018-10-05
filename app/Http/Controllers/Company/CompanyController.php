<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company\Company;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanyCollection;
use Validator;

class CompanyController extends Controller
{

    /**
     * @OAS\Post(
     *     path="company/read",
     *     tags={"Company"},
     *     summary="List of Company",
     *     @OAS\Response(
     *         response=200,
     *         description="Ok",
     *         @OAS\JsonContent(
     *             type="array",
     *             @OAS\Items(ref="#/../../Models/Company/Company")
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
            $company = Company::with('company')->whereId($request->id)->first();
            return new CompanyResource($company);
        } elseif (isset($request->items)) {
            $company = Company::with('company')->paginate($request->items);
            return new CompanyCollection($company);
        } else {
            $company = Company::with('company')->get();
            return CompanyCollection::collection($company);
        }
    }

    /**
     * @OAS\Post(
     *     path="company/create",
     *     tags={"Company"},
     *     summary="Create a Company",
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
            'name' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $company = new Company();
        $input = $request->all();
        $company->fill($input)->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="company/update",
     *     tags={"Company"},
     *     summary="Update a Company",
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
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $company = Company::find($request->id);
        $input = $request->all();
        $company->fill($input)->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="company/delete",
     *     tags={"Company"},
     *     summary="Delete a Company",
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
    public function delete(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $company = Company::find($request->id);
        $company->delete();

        return response()->json([
            'status' => 'ok'
        ]);
    }

}

?>