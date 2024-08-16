<?php declare(strict_types=1);

namespace Dormilich\RIPE\Factory;

use Dormilich\RIPE\Entity;
use Dormilich\RIPE\RipeInterface;
use OutOfBoundsException;
use ReflectionObject;

use function array_key_exists;
use function sprintf;

class EntityFactory implements EntityFactoryInterface
{
    /**
     * @var array<string, class-string<RipeInterface>>
     */
    private array $types = [];

    public function __construct()
    {
        $this->init();
    }

    /**
     * Allow to overwrite class mappings.
     *
     * @param RipeInterface $object
     * @return void
     */
    public function setClass(RipeInterface $object): void
    {
        $this->types[$object->getType()] = $object::class;
    }

    /**
     * @inheritDoc
     */
    public function create(string $type, ?string $handle = null): RipeInterface
    {
        $class = $this->getClass($type);

        return new $class($handle);
    }

    /**
     * Apply configured transformers to an object.
     *
     * @param RipeInterface $object
     * @return RipeInterface
     */
    public function addTransformers(RipeInterface $object): RipeInterface
    {
        $ro = new ReflectionObject($object);

        /** @var Transformator $attribute */
        foreach ($ro->getAttributes() as $ra) {
            try {
                $attribute = $ra->newInstance();
                $object->attr($attribute->getName())->apply($attribute->getTransformer());
            } catch (\Exception) {
                continue;
            }
        }

        return $object;
    }

    /**
     * Set up the class map.
     *
     * @return void
     */
    private function init(): void
    {
        $this->types['as-block'] = Entity\AsBlock::class;
        $this->types['as-set'] = Entity\AsSet::class;
        $this->types['aut-num'] = Entity\AutNum::class;
        $this->types['domain'] = Entity\Domain::class;
        $this->types['filter-set'] = Entity\FilterSet::class;
        $this->types['inet6num'] = Entity\Inet6num::class;
        $this->types['inetnum'] = Entity\Inetnum::class;
        $this->types['inet-rtr'] = Entity\InetRtr::class;
        $this->types['irt'] = Entity\Irt::class;
        $this->types['key-cert'] = Entity\KeyCert::class;
        $this->types['mntner'] = Entity\Mntner::class;
        $this->types['organisation'] = Entity\Organisation::class;
        $this->types['peering-set'] = Entity\PeeringSet::class;
        $this->types['person'] = Entity\Person::class;
        $this->types['poem'] = Entity\Poem::class;
        $this->types['poetic-form'] = Entity\PoeticForm::class;
        $this->types['role'] = Entity\Role::class;
        $this->types['route'] = Entity\Route::class;
        $this->types['route6'] = Entity\Route6::class;
        $this->types['route-set'] = Entity\RouteSet::class;
        $this->types['rtr-set'] = Entity\RtrSet::class;
    }

    /**
     * @param string $type
     * @return class-string<RipeInterface>
     * @throws OutOfBoundsException
     */
    private function getClass(string $type): string
    {
        if (array_key_exists($type, $this->types)) {
            return $this->types[$type];
        }

        $message = sprintf('Object of type "%s" does not exist.', $type);
        throw new OutOfBoundsException($message);
    }
}
