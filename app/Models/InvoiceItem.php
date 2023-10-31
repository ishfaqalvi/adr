<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class InvoiceItem
 *
 * @property $id
 * @property $invoice_id
 * @property $chemical_id
 * @property $point
 * @property $quantity
 * @property $created_at
 * @property $updated_at
 *
 * @property Chemical $chemical
 * @property Invoice $invoice
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class InvoiceItem extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['invoice_id','chemical_id','packaging_id','point','quantity'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function packaging()
    {
        return $this->hasOne('App\Models\Packaging', 'id', 'packaging_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chemical()
    {
        return $this->hasOne('App\Models\Chemical', 'id', 'chemical_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invoice()
    {
        return $this->hasOne('App\Models\Invoice', 'id', 'invoice_id');
    }
    

}
