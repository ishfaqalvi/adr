<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\InvoiceItem;
use Illuminate\Http\Request;

/**
 * Class InvoiceItemController
 * @package App\Http\Controllers
 */
class InvoiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:invoiceItems-list',  ['only' => ['index']]);
        $this->middleware('permission:invoiceItems-view',  ['only' => ['show']]);
        $this->middleware('permission:invoiceItems-create',['only' => ['create','store']]);
        $this->middleware('permission:invoiceItems-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:invoiceItems-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoiceItems = InvoiceItem::get();

        return view('admin.invoice-item.index', compact('invoiceItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoiceItem = new InvoiceItem();
        return view('admin.invoice-item.create', compact('invoiceItem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $invoiceItem = InvoiceItem::create($request->all());
        return redirect()->route('invoice-items.index')
            ->with('success', 'InvoiceItem created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoiceItem = InvoiceItem::find($id);

        return view('admin.invoice-item.show', compact('invoiceItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoiceItem = InvoiceItem::find($id);

        return view('admin.invoice-item.edit', compact('invoiceItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  InvoiceItem $invoiceItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceItem $invoiceItem)
    {
        $invoiceItem->update($request->all());

        return redirect()->route('invoice-items.index')
            ->with('success', 'InvoiceItem updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $invoiceItem = InvoiceItem::find($id)->delete();

        return redirect()->route('invoice-items.index')
            ->with('success', 'InvoiceItem deleted successfully');
    }
}
