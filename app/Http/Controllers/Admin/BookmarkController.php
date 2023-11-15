<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Bookmark;
use Illuminate\Http\Request;

/**
 * Class BookmarkController
 * @package App\Http\Controllers
 */
class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:bookmarks-list',  ['only' => ['index']]);
        $this->middleware('permission:bookmarks-view',  ['only' => ['show']]);
        $this->middleware('permission:bookmarks-create',['only' => ['create','store']]);
        $this->middleware('permission:bookmarks-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:bookmarks-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookmarks = Bookmark::get();

        return view('admin.bookmark.index', compact('bookmarks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookmark = new Bookmark();
        return view('admin.bookmark.create', compact('bookmark'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $bookmark = Bookmark::create($request->all());
        return redirect()->route('bookmarks.index')
            ->with('success', 'Bookmark created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bookmark = Bookmark::find($id);

        return view('admin.bookmark.show', compact('bookmark'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bookmark = Bookmark::find($id);

        return view('admin.bookmark.edit', compact('bookmark'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Bookmark $bookmark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bookmark $bookmark)
    {
        $bookmark->update($request->all());

        return redirect()->route('bookmarks.index')
            ->with('success', 'Bookmark updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bookmark = Bookmark::find($id)->delete();

        return redirect()->route('bookmarks.index')
            ->with('success', 'Bookmark deleted successfully');
    }
}
