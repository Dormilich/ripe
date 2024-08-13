<?php

namespace Dormilich\RIPE\Factory;

use Dormilich\RPSL\Transformer\TransformerInterface;
use Exception;

interface Transformator
{
    /**
     * @return string Name of the affected attribute.
     */
    public function getName(): string;

    /**
     * Instantiate the transformer to apply to the attribute.
     *
     * @return TransformerInterface
     * @throws Exception
     */
    public function getTransformer(): TransformerInterface;
}
