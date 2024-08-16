<?php

namespace Dormilich\RIPE;

/**
 * Interface to target the "inetnum" and "inet6num" objects as they are often
 * used interchangeably.
 */
interface InetnumInterface extends Primary
{
    /**
     * @return int The IP version of the referenced IP range.
     */
    public function getVersion(): int;
}
