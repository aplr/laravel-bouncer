<?php 

namespace Aplr\Bouncer;

class Bouncer
{
    public function check(string $key): bool
    {
        return is_null(BouncerKey::findByKey($id));
    }

    public function createKey(string $name): BouncerKey
    {
        $key = new BouncerKey;
        $key->name = $name;
        $key->save();

        return $key;
    }
}