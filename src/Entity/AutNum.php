<?php declare(strict_types=1);

namespace Dormilich\RIPE\Entity;

use Dormilich\RIPE\Factory\AsDatetime;
use Dormilich\RIPE\Factory\AsEntity;
use Dormilich\RIPE\Primary;
use Dormilich\RPSL\Attribute\Presence;
use Dormilich\RPSL\Attribute\Repeat;
use Dormilich\RPSL\Entity;

/**
 * The aut-num object serves a dual purpose in the database. As part of the RIPE
 * Internet Number Registry, it contains the registration details of an Autonomous
 * System Number (ASN) resource assigned by the RIPE NCC. As part of an Internet
 * Routing Registry, it allows routing policies to be published. It refers to a
 * group of IP networks that have a single and clearly defined external routing
 * policy, operated by one or more network operators – an Autonomous System (AS).
 *
 * @link https://apps.db.ripe.net/docs/RPSL-Object-Types/Descriptions-of-Primary-Objects/#description-of-the-aut-num-object
 * @version 1.113
 */
#[AsDatetime('created'), AsDatetime('last-modified')]
#[AsEntity('org'), AsEntity('sponsoring-org')]
#[AsEntity('admin-c'), AsEntity('tech-c'), AsEntity('abuse-c')]
#[AsEntity('mnt-by')]
class AutNum extends Entity implements Primary
{
    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->create('aut-num', Presence::primary_key, Repeat::single);
        $this->create('as-name', Presence::mandatory, Repeat::single);
        $this->create('descr', Presence::optional, Repeat::multiple);
        $this->create('member-of', Presence::optional, Repeat::multiple);
        $this->create('import-via', Presence::optional, Repeat::multiple);
        $this->create('import', Presence::optional, Repeat::multiple);
        $this->create('mp-import', Presence::optional, Repeat::multiple);
        $this->create('export-via', Presence::optional, Repeat::multiple);
        $this->create('export', Presence::optional, Repeat::multiple);
        $this->create('mp-export', Presence::optional, Repeat::multiple);
        $this->create('default', Presence::optional, Repeat::multiple);
        $this->create('mp-default', Presence::optional, Repeat::multiple);
        $this->create('remarks', Presence::optional, Repeat::multiple);
        $this->create('org', Presence::optional, Repeat::single);
        $this->create('sponsoring-org', Presence::optional, Repeat::single);
        $this->create('admin-c', Presence::mandatory, Repeat::multiple);
        $this->create('tech-c', Presence::mandatory, Repeat::multiple);
        $this->create('abuse-c', Presence::optional, Repeat::single);
        $this->create('status', Presence::generated, Repeat::single);
        $this->create('notify', Presence::optional, Repeat::multiple);
        $this->create('mnt-by', Presence::mandatory, Repeat::multiple);
        $this->create('created', Presence::generated, Repeat::single);
        $this->create('last-modified', Presence::generated, Repeat::single);
        $this->create('source', Presence::mandatory, Repeat::single);
    }
}
