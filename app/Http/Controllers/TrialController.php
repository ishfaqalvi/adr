<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Trial;
use Illuminate\Http\Request;

/**
 * Class TrialController
 * @package App\Http\Controllers
 */
class TrialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:trials-list',  ['only' => ['index']]);
        $this->middleware('permission:trials-view',  ['only' => ['show']]);
        $this->middleware('permission:trials-create',['only' => ['create','store']]);
        $this->middleware('permission:trials-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:trials-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trials = Trial::get();

        return view('admin.trial.index', compact('trials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trial = new Trial();
        return view('admin.trial.create', compact('trial'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $trial = Trial::create($request->all());
        return redirect()->route('trials.index')
            ->with('success', 'Trial created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trial = Trial::find($id);

        return view('admin.trial.show', compact('trial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trial = Trial::find($id);

        return view('admin.trial.edit', compact('trial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Trial $trial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trial $trial)
    {
        $trial->update($request->all());

        return redirect()->route('trials.index')
            ->with('success', 'Trial updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $trial = Trial::find($id)->delete();

        return redirect()->route('trials.index')
            ->with('success', 'Trial deleted successfully');
    }
}
