<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Carbon\Carbon;

/**
 * Class Trial
 *
 * @property $id
 * @property $user_id
 * @property $start_date
 * @property $end_date
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Trial extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $appends = ['status'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','start_date','end_date'];

    public function getStatusAttribute()
    {
        $today = Carbon::now()->timestamp;
        if ($today >= $this->start_date && $today <= $this->end_date) {
            return 'Active';
        } else {
            return 'Expired';
        }
    }

    /**
     * Interact with the start date.
     */
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = strtotime($value);
    }

    /**
     * Interact with the end days.
     */
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = strtotime($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}