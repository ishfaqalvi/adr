<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController;

use Illuminate\Support\Facades\Validator;
use App\Models\Packaging;
use Illuminate\Http\Request;

/**
 * Class PackagingController
 * @package App\Http\Controllers
 */
class PackagingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packagings = Packaging::own()->get();

        return $this->sendResponse($packagings, 'Packaging list get successfully.');
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
                'name' => 'required|string|max:50'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $packaging = auth()->user()->packagings()->create($request->all());
            return $this->sendResponse($packaging, 'Packaging created successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Packaging $packaging
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Packaging $packaging)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:50'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            if ($packaging->default == 1) {
                return $this->sendError('Default Record.', 'Oops! You can not change default records.');
            }
            $packaging->update($request->all());
            return $this->sendResponse($packaging, 'Packaging updated successfully.');
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
        $packaging = Packaging::find($id);
        if ($packaging->default == 1) {
            return $this->sendError('Default Record.', 'Oops! You can not delete default records.');
        }
        $packaging->delete();
        return $this->sendResponse('', 'Packaging deleted successfully.');
    }
}
