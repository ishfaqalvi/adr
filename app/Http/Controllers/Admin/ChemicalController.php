<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Chemical;
use Illuminate\Http\Request;

/**
 * Class ChemicalController
 * @package App\Http\Controllers
 */
class ChemicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chemicals = Chemical::get();

        return view('admin.chemical.index', compact('chemicals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chemical = new Chemical();
        return view('admin.chemical.create', compact('chemical'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Chemical::$rules);

        $chemical = Chemical::create($request->all());

        return redirect()->route('chemicals.index')
            ->with('success', 'Chemical created successfully.');
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

        return view('admin.chemical.show', compact('chemical'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chemical = Chemical::find($id);

        return view('admin.chemical.edit', compact('chemical'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Chemical $chemical
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chemical $chemical)
    {
        request()->validate(Chemical::$rules);

        $chemical->update($request->all());

        return redirect()->route('chemicals.index')
            ->with('success', 'Chemical updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $chemical = Chemical::find($id)->delete();

        return redirect()->route('chemicals.index')
            ->with('success', 'Chemical deleted successfully');
    }
}
