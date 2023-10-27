<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Invoice
 *
 * @property $id
 * @property $user_id
 * @property $consignee_id
 * @property $shipment_type
 * @property $invoice_date
 * @property $file
 * @property $total_points
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Consignee $consignee
 * @property InvoiceItem[] $invoiceItems
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Invoice extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'consignee_id',
        'shipment_type',
        'sub_type',
        'invoice_date',
        'file',
        'total_points',
        'status'
    ];

    /**
     * Interact with the duration days.
     */
    public function setInvoiceDateAttribute($value)
    {
        $this->attributes['invoice_date'] = strtotime($value);
    }

    /**
     * Set the attachment's.
     * @param  string  $value
     * @return void
     */
    public function setFileAttribute($file)
    {
        if($file) {
            $name = $file->getClientOriginalName();
            $file->move('upload/images/invoice', $name);
            $this->attributes['file'] = 'upload/images/invoice/'.$name;
        }else{
            unset($this->attributes['file']);
        }
    }

    /**
     * Get the attachment's.
     * @param  string  $value
     * @return void
     */
    public function getFileAttribute($file)
    {
        if($file) { return asset($file); }
    }

    /**
     * Scope model query.
     *
     * @var array
     */
    public function scopeOwn($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    /**
     * Scope model query.
     *
     * @var array
     */
    public function scopeOwnBulk($query)
    {
        return $query->where('user_id', auth()->user()->id)->where('shipment_type','Bulk');
    }

    /**
     * Scope model query.
     *
     * @var array
     */
    public function scopeOwnOther($query)
    {
        return $query->where('user_id', auth()->user()->id)->where('shipment_type','1136');
    }

    /**
     * Scope model query.
     *
     * @var array
     */
    public function scopeMonthly($query)
    {
        return $query->whereBetween('invoice_date', [strtotime(date('Y-m-01 00:00:00')), strtotime(date('Y-m-t 23:59:59'))]);
    }

    /**
     * Scope model query.
     *
     * @var array
     */
    public function scopeYearly($query)
    {
        return $query->whereBetween('invoice_date', [strtotime(date('Y-01-01 00:00:00')), strtotime(date('Y-12-31 23:59:59'))]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function consignee()
    {
        return $this->hasOne('App\Models\Consignee', 'id', 'consignee_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoiceItems()
    {
        return $this->hasMany('App\Models\InvoiceItem', 'invoice_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
