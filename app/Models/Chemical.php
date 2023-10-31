<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Chemical
 *
 * @property $id
 * @property $un_number
 * @property $name_en
 * @property $name_it
 * @property $class
 * @property $classification_code
 * @property $packing_group
 * @property $label
 * @property $special_provisions
 * @property $limited
 * @property $expected_quantities
 * @property $packing_instruction
 * @property $special_packing_provision
 * @property $mixed_packing_provision
 * @property $instructions
 * @property $p_tank_special_provisions
 * @property $tank_code
 * @property $ard_special_provisions
 * @property $vehicle_for_tank_carriage
 * @property $trc_transport_category
 * @property $packages
 * @property $bulk
 * @property $loading_unloading_handling
 * @property $operation
 * @property $hazard_identification_no
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Chemical extends Model
{
    
    static $rules = [
		'un_number' => 'required',
		'name_en' => 'required',
		'name_it' => 'required',
		'class' => 'required',
		'classification_code' => 'required',
		'packing_group' => 'required',
		'label' => 'required',
		'special_provisions' => 'required',
		'limited' => 'required',
		'expected_quantities' => 'required',
		'packing_instruction' => 'required',
		'special_packing_provision' => 'required',
		'mixed_packing_provision' => 'required',
		'instructions' => 'required',
		'p_tank_special_provisions' => 'required',
		'tank_code' => 'required',
		'ard_special_provisions' => 'required',
		'vehicle_for_tank_carriage' => 'required',
		'trc_transport_category' => 'required',
		'packages' => 'required',
		'bulk' => 'required',
		'loading_unloading_handling' => 'required',
		'operation' => 'required',
		'hazard_identification_no' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'un_number',
    	'name_en',
    	'name_it',
    	'class',
    	'classification_code',
    	'packing_group',
    	'label',
    	'special_provisions',
    	'limited',
    	'expected_quantities',
    	'packing_instruction',
    	'special_packing_provision',
    	'mixed_packing_provision',
    	'instructions',
    	'p_tank_special_provisions',
    	'tank_code',
    	'ard_special_provisions',
    	'vehicle_for_tank_carriage',
    	'trc_transport_category',
    	'packages',
    	'bulk',
    	'loading_unloading_handling',
    	'operation',
    	'hazard_identification_no'
    ];

    /**
     * The get attributes.
     *
     * @var array
     */
    public function getUnNumberAttribute($number)
    {
    	if (isset($number)) {
    		return 'UN'.$number;
    	}
    }

    /**
     * The get attributes.
     *
     * @var array
     */
    public function getLabelAttribute($value)
    {
    	return str_replace(' ', '+', $value);
    }

    /**
     * Scope model query.
     *
     * @var array
     */
    public function scopeFilter($query, $request)
    {
    	if(isset($request['un_number']))
    	{
    		$query->where('un_number', $request['un_number']);
    	}
    	elseif(isset($request['name_en']))
    	{
    		$query->where('name_en', 'like', '%'.$request['name_en'].'%');
    	}
    	elseif (isset($request['name_it']))
    	{
    		$query->where('name_it', 'like', '%'.$request['name_it'].'%');
    	}
        return $query;
    }
}
