<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Bookmark
 *
 * @property $id
 * @property $user_id
 * @property $chemical_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Chemical $chemical
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Bookmark extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','chemical_id'];


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
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
