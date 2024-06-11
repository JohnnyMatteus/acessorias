<?php
namespace App\Model;

trait Uuid
{
    protected static function bootUuid()
    {
        static::creating(function ($obj) {
            $obj->uuid = \Ramsey\Uuid\Uuid::uuid4();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getModelByUuid($class, $uuid)
    {
        return $class::findByUuid($uuid);
    }
}
?>
