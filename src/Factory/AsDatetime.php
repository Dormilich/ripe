<?php declare(strict_types=1);

namespace Dormilich\RIPE\Factory;

use Attribute;
use DateTimeImmutable;
use DateTimeZone;
use Dormilich\RPSL\Transformer\DatetimeTransformer;
use Dormilich\RPSL\Transformer\TransformerInterface;

use function date_default_timezone_get;

/**
 * Apply the datetime transformer to an attribute.
 */
#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class AsDatetime implements Transformator
{
    private string $timezone;

    /**
     * @param string $name
     * @param string|null $timezone
     */
    public function __construct(private readonly string $name, string $timezone = null)
    {
        $this->timezone = $timezone ?: date_default_timezone_get();
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
        $tz = new DateTimeZone($this->timezone);
        $date = new DateTimeImmutable('now', $tz);

        return new DatetimeTransformer($date);
    }
}
