<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
	use SoftDeletes;

    protected $fillable = ['name', 'description', 'price', 'total_in_shelf', 'total_in_vault', 'store_id', 'deleted_at'];
    protected $dates = ['deleted_at'];


    /**
     * @return mixed
     */
    public function store()
    {
        return $this->belongsTo('App\Store');
    }
}
