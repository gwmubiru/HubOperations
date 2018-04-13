<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model {
	protected $table = "samples";
	//specify the fields that must be filled
    protected $fillable = [
        'hubid', 'facilityid', 'bikeid', 'thedate'
    ];
	/**
	* Relationship with hub
	*/
	public function hub()
	{
		return $this->belongsTo('App\Models\Facility', 'hubid', 'id');
	}
	/**
	* Relationship with hub
	*/
	public function facility()
	{
		return $this->belongsTo('App\Models\Facility', 'facilityid', 'id');
	}
}
