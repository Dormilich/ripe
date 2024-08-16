<?php

namespace Dormilich\RIPE\Factory;

use Dormilich\RIPE\RipeInterface;
use Dormilich\RPSL\FactoryInterface;
use Exception;

interface EntityFactoryInterface extends FactoryInterface
{
    /**
     * Create RIPE object from its type.
     *
     * @param string $type
     * @param string|null $handle
     * @return RipeInterface
     * @throws Exception
     */
    public function create(string $type, ?string $handle = null): RipeInterface;

    /**
     * Apply configured transformers to an object.
     *
     * @param RipeInterface $object
     * @return RipeInterface
     */
    public function addTransformers(RipeInterface $object): RipeInterface;
}
