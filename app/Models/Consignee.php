<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Consignee
 *
 * @property $id
 * @property $user_id
 * @property $name
 * @property $city_postal_code
 * @property $address
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Consignee extends Model
{
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','name','city_postal_code','address'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
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
}
