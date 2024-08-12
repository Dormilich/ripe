<?php declare(strict_types=1);

namespace Dormilich\RIPE\Entity;

use Dormilich\RIPE\InetnumInterface;
use Dormilich\RIPE\Primary;
use Dormilich\RPSL\Attribute\Presence;
use Dormilich\RPSL\Attribute\Repeat;
use Dormilich\RPSL\Entity;

/**
 * An inetnum object contains information on allocations and assignments of IPv4
 * address space resources. This is one of the main elements of the RIPE Internet
 * Number Registry.
 *
 * @link https://apps.db.ripe.net/docs/RPSL-Object-Types/Descriptions-of-Primary-Objects/#description-of-the-inetnum-object
 * @version 1.113
 */
class Inetnum extends Entity implements Primary, InetnumInterface
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
        // Addresses can be expressed in either range or prefix notation.
        // If prefix notation is used, the software will convert this to range notation.
        $this->create('inetnum', Presence::primary_key, Repeat::single);
        $this->create('netname', Presence::mandatory, Repeat::single);
        $this->create('descr', Presence::optional, Repeat::multiple);
        $this->create('country', Presence::mandatory, Repeat::multiple);
        $this->create('geofeed', Presence::optional, Repeat::single);
        $this->create('geoloc', Presence::optional, Repeat::single);
        $this->create('language', Presence::optional, Repeat::multiple);
        $this->create('org', Presence::optional, Repeat::single);
        $this->create('sponsoring-org', Presence::optional, Repeat::single);
        $this->create('admin-c', Presence::mandatory, Repeat::multiple);
        $this->create('tech-c', Presence::mandatory, Repeat::multiple);
        $this->create('abuse-c', Presence::optional, Repeat::single);
        $this->create('status', Presence::mandatory, Repeat::single);
        $this->create('assignment-size', Presence::optional, Repeat::single);
        $this->create('remarks', Presence::optional, Repeat::multiple);
        $this->create('notify', Presence::optional, Repeat::multiple);
        $this->create('mnt-by', Presence::mandatory, Repeat::multiple);
        $this->create('mnt-lower', Presence::optional, Repeat::multiple);
        $this->create('mnt-domains', Presence::optional, Repeat::multiple);
        $this->create('mnt-routes', Presence::optional, Repeat::multiple);
        $this->create('mnt-irt', Presence::optional, Repeat::multiple);
        $this->create('created', Presence::generated, Repeat::single);
        $this->create('last-modified', Presence::generated, Repeat::single);
        $this->create('source', Presence::mandatory, Repeat::single);
    }
}
