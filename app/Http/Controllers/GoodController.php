<?php

namespace App\Http\Controllers;

use App\Enums\GoodCategory;
use App\Models\Good;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $goods = Good::paginate(15);
        return response()->json(["goods" => $goods], ResponseAlias::HTTP_OK);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = $this->validate($input, [
            'name' => 'required',
            'category' => ['required', new Enum(GoodCategory::class)],
            'serial_numbeer' => ['required', 'unique:goods', 'max:255']
        ]);

        $good = new Good();
        $good->fill($input);
        $good->save();
        return response()->json([
            "message" => "Good created successfully.",
            "data" => $good
        ], ResponseAlias::HTTP_CREATED);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $good = Good::findOrFail($id);
        if (empty($good)) {
            return $this->sendError('Good not found.');
        }
        return response()->json([
            "message" => "Good retrieved successfully.",
            "data" => $good
        ], ResponseAlias::HTTP_OK);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $input = $request->all();
        $validator = $this->validate($input, [
            'name' => 'required',
            'category' => ['required', new Enum(GoodCategory::class)],
            'serial_numbeer' => ['required', 'unique:goods', 'max:255']
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

       $good = Good::findOrFail($id);
        if (!empty($good)) {
            $good->fill($input);
            $good->save();
            return response()->json([
                "message" => "Good updated successfully.",
                "data" => $good
            ], ResponseAlias::HTTP_OK);
        }
        return \response("Not found", ResponseAlias::HTTP_BAD_REQUEST);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Good::find($id)->delete();
        return response()->json([
            "message" => "Good deleted successfully.",
        ], ResponseAlias::HTTP_OK);
    }
}
