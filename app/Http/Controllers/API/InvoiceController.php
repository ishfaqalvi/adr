<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController;

use Illuminate\Support\Facades\Validator;
use App\Models\Invoice;
use Illuminate\Http\Request;

/**
 * Class InvoiceController
 * @package App\Http\Controllers
 */
class InvoiceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();
        $currentY = now()->year;
        $serial = 0;
        $invoices = Invoice::filter($request->all())->own()->with('consignee','user','invoiceItems.packaging','invoiceItems.chemical')->withCount('invoiceItems')->get();
        foreach($invoices as $invoice)
        {
            $year = date('Y', $invoice->invoice_date);
            if ($currentY != $year) {
                $currentY = $year;
                $serial = 1;
            }else{
                ++$serial;  
            }
            $invoice->record_number = $serial.'/'. $currentY;
            $data[] = $invoice;
        }
        return $this->sendResponse($invoices, 'Invoice list get successfully.');
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
                'consignee_id'       => 'required',
                'shipment_type'      => 'required',
                'invoice_date'       => 'required',
                'total_points'       => 'required',
                'items'              => 'required|array',
                'items.*.chemical_id'=> 'required|integer',
                'items.*.packaging_id'=> 'nullable|integer',
                'items.*.point'      => 'required|integer',
                'items.*.quantity'   => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $invoice = auth()->user()->invoices()->create($request->all());
            foreach($request->items as $item){
                $invoice->invoiceItems()->create($item);
            }
            return $this->sendResponse($invoice, 'Invoice created successfully.');
        } catch (\Throwable $th) {
            return $this->sendException($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $invoice = Invoice::with('consignee','user','invoiceItems.packaging','invoiceItems.chemical')->find($id);

        return $this->sendResponse($invoice, 'Invoice detail get successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        try {
            $validator = Validator::make($request->all(), [
                'consignee_id'       => 'required',
                'shipment_type'      => 'required',
                'invoice_date'       => 'required',
                'total_points'       => 'required',
                'items'              => 'required|array',
                'items.*.chemical_id'=> 'required|integer',
                'items.*.packaging_id'=> 'nullable|integer',
                'items.*.point'      => 'required|integer',
                'items.*.quantity'   => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $invoice->update($request->all());
            $invoice->invoiceItems()->delete();
            foreach($request->items as $item){
                $invoice->invoiceItems()->create($item);
            }
            return $this->sendResponse($invoice, 'Invoice updated successfully.');
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
        $invoice = Invoice::find($id);
        $invoice->invoiceItems()->delete();
        $invoice->delete();
        return $this->sendResponse('', 'Invoice deleted successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function checkLimit()
    {
        $bulk['month']= Invoice::ownBulk()->monthly()->count();

        $bulk['year'] = Invoice::ownBulk()->yearly()->count();
        
        $other['month']= Invoice::ownOther()->monthly()->count();
        $other['year'] = Invoice::ownOther()->yearly()->count(); 

        return $this->sendResponse(['bulk' => $bulk, '1136' => $other], 'Invoice limit get successfully.');
    }
}
