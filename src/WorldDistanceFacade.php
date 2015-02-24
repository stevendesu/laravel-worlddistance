<?php namespace Stevendesu\WorldDistance;

use Illuminate\Support\Facades\Facade;

class WorldDistanceFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'distance'; }

}