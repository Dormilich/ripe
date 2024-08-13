<?php declare(strict_types=1);

namespace Dormilich\RIPE\Factory;

use Attribute;
use Dormilich\RPSL\Transformer\HandleTransformer;
use Dormilich\RPSL\Transformer\TransformerInterface;

/**
 * Apply the RPSL object transformer to an attribute.
 */
#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class AsEntity implements Transformator
{
    /**
     * @param string $name
     */
    public function __construct(private readonly string $name)
    {
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getTransformer(): TransformerInterface
    {
        return new HandleTransformer(new EntityFactory());
    }
}
