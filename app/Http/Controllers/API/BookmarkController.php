<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController;

use Illuminate\Support\Facades\Validator;
use App\Models\Bookmark;
use Illuminate\Http\Request;

/**
 * Class BookmarkController
 * @package App\Http\Controllers
 */
class BookmarkController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookmarks = auth()->user()->bookmarks()->with('chemical')->get();

        return $this->sendResponse($bookmarks, 'Bookmark list get successfully.');
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
                'chemical_id' => 'required'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            auth()->user()->bookmarks()->create($request->all());
            $bookmarks = auth()->user()->bookmarks()->with('chemical')->get();
            return $this->sendResponse($bookmarks, 'Bookmark list updated successfully.');
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
        Bookmark::find($id)->delete();

        return $this->sendResponse('', 'Bookmark deleted successfully.');
    }
}
