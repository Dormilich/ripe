<?php declare(strict_types=1);

namespace Dormilich\RIPE\Entity;

use Dormilich\RIPE\Factory\AsDatetime;
use Dormilich\RIPE\Factory\AsEntity;
use Dormilich\RIPE\InetnumInterface;
use Dormilich\RIPE\Primary;
use Dormilich\RPSL\Attribute\Presence;
use Dormilich\RPSL\Attribute\Repeat;
use Dormilich\RPSL\Entity;

/**
 * An inet6num object contains information on allocations and assignments of IPv6
 * address space resources. This is one of the main elements of the RIPE Internet
 * Number Registry.
 *
 * @link https://apps.db.ripe.net/docs/RPSL-Object-Types/Descriptions-of-Primary-Objects/#description-of-the-inet6num-object
 * @version 1.113
 */
#[AsDatetime('created'), AsDatetime('last-modified')]
#[AsEntity('org'), AsEntity('sponsoring-org')]
#[AsEntity('admin-c'), AsEntity('tech-c'), AsEntity('abuse-c')]
#[AsEntity('mnt-by'), AsEntity('mnt-domains'), AsEntity('mnt-irt'), AsEntity('mnt-lower'), AsEntity('mnt-routes')]
class Inet6num extends Entity implements Primary, InetnumInterface
{
    /**
     * @inheritDoc
     */
    public function getVersion(): int
    {
        return 6;
    }

    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        // Addresses can only be expressed in a prefix notation. The prefix is
        // converted to a canonical format where necessary.
        $this->create('inet6num', Presence::primary_key, Repeat::single);
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
        $this->create('mnt-routes', Presence::optional, Repeat::multiple);
        $this->create('mnt-domains', Presence::optional, Repeat::multiple);
        $this->create('mnt-irt', Presence::optional, Repeat::multiple);
        $this->create('created', Presence::generated, Repeat::single);
        $this->create('last-modified', Presence::generated, Repeat::single);
        $this->create('source', Presence::mandatory, Repeat::single);
    }
}

/*
Accepted status values:

ALLOCATED-BY-RIR
    This is mostly used to identify blocks of addresses for which the RIPE NCC
    is administratively responsible and allocations made to members by the RIPE
    NCC.
ALLOCATED-BY-LIR
    This is equivalent to the inetnum status SUB-ALLOCATED PA. A member can sub-
    allocate part of an allocation to another organisation. The other organisation
    may take over some of the management of this sub-allocation. However, the
    RIPE NCC member is still responsible for the whole of their registered
    resources, even if some parts of it have been sub-allocated to another
    organisation. Provisions have been built in to the RIPE Database software to
    ensure that the member is always technically in control of their allocated
    address space. Within such allocation, it is still required to document
    assignments using the status "AGGREGATED-BY-LIR" or "ASSIGNED". With the
    inet6num object there is no equivalent to the inetnum LIR-PARTITIONED status
    values allowing partitioning of an allocation by a member for internal
    business reasons.
AGGREGATED-BY-LIR
    With IPv6, it is not necessary to document each individual End User assignment
    in the RIPE Database. If you have a group of End Users who all require blocks
    of addresses of the same size, say a /56, then you can create a large, single
    block with this status. The “assignment-size:” attribute specifies the size
    of the End User blocks. All assignments made from this block must have that
    size. It is possible to have two levels of ‘AGGREGATED-BY-LIR'. The "assignment-
    size" value cannot be changed after the inet6num object has been created.
ASSIGNED PI
    These are assignments made by the RIPE NCC directly to an End User. In most
    cases, there is a member acting as the sponsoring organisation who handles
    the administrative processes on behalf of the End User. The sponsoring
    organisation may also manage the resource and related objects in the RIPE
    Database for the End User.
ASSIGNED ANYCAST
    This address space has been assigned for use in TLD anycast networks.
 */
