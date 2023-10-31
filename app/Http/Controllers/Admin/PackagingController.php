<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Packaging;
use Illuminate\Http\Request;

/**
 * Class PackagingController
 * @package App\Http\Controllers
 */
class PackagingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:packagings-list',  ['only' => ['index']]);
        $this->middleware('permission:packagings-view',  ['only' => ['show']]);
        $this->middleware('permission:packagings-create',['only' => ['create','store']]);
        $this->middleware('permission:packagings-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:packagings-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packagings = Packaging::get();

        return view('admin.packaging.index', compact('packagings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packaging = new Packaging();
        return view('admin.packaging.create', compact('packaging'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $packaging = Packaging::create($request->all());
        return redirect()->route('packagings.index')
            ->with('success', 'Packaging created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $packaging = Packaging::find($id);

        return view('admin.packaging.show', compact('packaging'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $packaging = Packaging::find($id);

        return view('admin.packaging.edit', compact('packaging'));
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
        $packaging->update($request->all());

        return redirect()->route('packagings.index')
            ->with('success', 'Packaging updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $packaging = Packaging::find($id)->delete();

        return redirect()->route('packagings.index')
            ->with('success', 'Packaging deleted successfully');
    }
}
