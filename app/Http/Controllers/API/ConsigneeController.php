<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController;

use Illuminate\Support\Facades\Validator;
use App\Models\Consignee;
use Illuminate\Http\Request;

/**
 * Class ConsigneeController
 * @package App\Http\Controllers
 */
class ConsigneeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consignees = Consignee::own()->get();
        return $this->sendResponse($consignees, 'Consignees list get successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'             => 'required|string|max:50',
                'city_postal_code' => 'required|string|max:20',
                'address'          => 'required|string|max:256'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $consignee = auth()->user()->consignees()->create($request->all());
            return $this->sendResponse($consignee, 'Consignee created successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Consignee $consignee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consignee $consignee)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'             => 'required|string|max:50',
                'city_postal_code' => 'required|string|max:20',
                'address'          => 'required|string|max:256'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $consignee->update($request->all());
            return $this->sendResponse($consignee, 'Consignee updated successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        Consignee::find($id)->delete();
        return $this->sendResponse('', 'Consignee deleted successfully.');
    }
}
