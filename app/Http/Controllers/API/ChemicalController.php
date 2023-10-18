<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController;

use Illuminate\Support\Facades\Validator;

use App\Models\Chemical;
use Illuminate\Http\Request;

/**
 * Class ChemicalController
 * @package App\Http\Controllers
 */
class ChemicalController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $chemicals = Chemical::filter($request->all())->paginate(15);
        return $this->sendResponse($chemicals, 'Chemicals list get successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chemical = Chemical::find($id);
        return $this->sendResponse($chemical, 'Chemicals data get successfully.');
    }
}
