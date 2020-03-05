<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    protected $table = 'affiliates';

   // protected $with = ['groups'];

    protected $fillable = [
        'name',
    ];

/*	protected $hidden = [
		'created_at', 'updated_at'
	];*/

    public function groups() {
        return $this->belongsToMany(Group::class);
    }
}
