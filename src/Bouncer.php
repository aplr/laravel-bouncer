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

    public function deleteKey(string $id)
    {
        BouncerKey::destroy($id);
    }

    public function updateKey(string $id, string $name): BouncerKey
    {
        $key = BouncerKey::findOrFail($id);
        $key->name = $name;
        $key->save();

        return $key;
    }

    public function getKeys()
    {
        return BouncerKey::all();
    }
}