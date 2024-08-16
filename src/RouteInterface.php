<?php

namespace Dormilich\RIPE;

/**
 * Interface to target the "route" and "route6" objects as they are often
 * used interchangeably.
 */
interface RouteInterface extends Primary
{
    /**
     * @return int The IP version of the referenced IP range.
     */
    public function getVersion(): int;
}
