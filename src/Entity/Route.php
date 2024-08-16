<?php declare(strict_types=1);

namespace Dormilich\RIPE\Entity;

use Dormilich\RIPE\Factory\AsDatetime;
use Dormilich\RIPE\Factory\AsEntity;
use Dormilich\RIPE\RouteInterface;
use Dormilich\RPSL\Attribute\Presence;
use Dormilich\RPSL\Attribute\Repeat;
use Dormilich\RPSL\Entity;

use function preg_match;

/**
 * A route object contains routing information for IPv4 address space resources.
 * This is one of the main elements of the RIPE Internet Routing Registry. Each
 * interAS route (also known as an interdomain route) originated by an Autonomous
 * System can be specified by using a route object for IPv4 addresses.
 *
 * @link https://apps.db.ripe.net/docs/RPSL-Object-Types/Descriptions-of-Primary-Objects/#description-of-the-route-object
 * @version 1.113
 */
#[AsDatetime('created'), AsDatetime('last-modified')]
#[AsEntity('org')]
#[AsEntity('mnt-by'), AsEntity('mnt-lower'), AsEntity('mnt-routes')]
class Route extends Entity implements RouteInterface
{
    /**
     * @inheritDoc
     */
    public function getVersion(): int
    {
        return 4;
    }

    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->create('route', Presence::primary_key, Repeat::single);
        $this->create('descr', Presence::optional, Repeat::multiple);
        $this->create('origin', Presence::primary_key, Repeat::single);
        $this->create('pingable', Presence::optional, Repeat::multiple);
        $this->create('ping-hdl', Presence::optional, Repeat::multiple);
        $this->create('holes', Presence::optional, Repeat::multiple);
        $this->create('org', Presence::optional, Repeat::multiple);
        $this->create('member-of', Presence::optional, Repeat::multiple);
        $this->create('inject', Presence::optional, Repeat::multiple);
        $this->create('aggr-mtd', Presence::optional, Repeat::single);
        $this->create('aggr-bndry', Presence::optional, Repeat::single);
        $this->create('export-comps', Presence::optional, Repeat::single);
        $this->create('components', Presence::optional, Repeat::single);
        $this->create('remarks', Presence::optional, Repeat::multiple);
        $this->create('notify', Presence::optional, Repeat::multiple);
        $this->create('mnt-lower', Presence::optional, Repeat::multiple);
        $this->create('mnt-routes', Presence::optional, Repeat::multiple);
        $this->create('mnt-by', Presence::mandatory, Repeat::multiple);
        $this->create('created', Presence::generated, Repeat::single);
        $this->create('last-modified', Presence::generated, Repeat::single);
        $this->create('source', Presence::mandatory, Repeat::single);
    }

    /**
     * @inheritDoc
     */
    protected function setHandle(?string $handle): void
    {
        if (preg_match('~^([0-9\./]+)(AS\d+)$~', (string) $handle, $match)) {
            $this->set('route', $match[1]);
            $this->set('origin', $match[2]);
        }
    }
}
