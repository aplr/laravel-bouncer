<?php

namespace Aplr\Bouncer;

use Illuminate\Database\Eloquent\Model;
use Aplr\Toolbox\Traits\UuidTrait;

class BouncerKey extends Model {

    use UuidTrait;

    protected $table = "bouncer_keys";

    public function getConnectionName()
    {
        return config('bouncer.connection');
    }
    
    public static function boot()
    {
        parent::boot();

        self::creating(function ($user) {
            $user->key = str_random(40);
        });
    }

    public static function findByKey($string)
    {
        return self::where('key', $string)->first();
    }

}