<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Consignee;
use Illuminate\Http\Request;

/**
 * Class ConsigneeController
 * @package App\Http\Controllers
 */
class ConsigneeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:consignees-list',  ['only' => ['index']]);
        $this->middleware('permission:consignees-view',  ['only' => ['show']]);
        $this->middleware('permission:consignees-create',['only' => ['create','store']]);
        $this->middleware('permission:consignees-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:consignees-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consignees = Consignee::get();

        return view('admin.consignee.index', compact('consignees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $consignee = new Consignee();
        return view('admin.consignee.create', compact('consignee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $consignee = Consignee::create($request->all());
        return redirect()->route('consignees.index')
            ->with('success', 'Consignee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consignee = Consignee::find($id);

        return view('admin.consignee.show', compact('consignee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $consignee = Consignee::find($id);

        return view('admin.consignee.edit', compact('consignee'));
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
        $consignee->update($request->all());

        return redirect()->route('consignees.index')
            ->with('success', 'Consignee updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $consignee = Consignee::find($id)->delete();

        return redirect()->route('consignees.index')
            ->with('success', 'Consignee deleted successfully');
    }
}
