<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Store extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'address', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];


    protected static function boot()
    {
        parent::boot();

        static::deleting(function($stores) {
            foreach ($stores->articles()->get() as $article) {
                $article->delete();
            }
        });
    }

    public function articles()
    {
        return $this->hasMany('App\Article');
    }
}
