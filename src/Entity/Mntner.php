<?php declare(strict_types=1);

namespace Dormilich\RIPE\Entity;

use Dormilich\RIPE\Factory\AsDatetime;
use Dormilich\RIPE\Factory\AsEntity;
use Dormilich\RIPE\Secondary;
use Dormilich\RPSL\Attribute\Presence;
use Dormilich\RPSL\Attribute\Repeat;
use Dormilich\RPSL\Entity;

/**
 * Objects in the RIPE Database are protected using mntner objects. A mntner
 * object is an anonymous box containing the credentials needed to authorise
 * creation, deletion or modification of any objects that it protects by whomever
 * maintains this data.
 *
 * @link https://apps.db.ripe.net/docs/RPSL-Object-Types/Descriptions-of-Secondary-Objects/#description-of-the-mntner-object
 * @version 1.113
 */
#[AsDatetime('created'), AsDatetime('last-modified')]
#[AsEntity('org')]
#[AsEntity('admin-c'), AsEntity('tech-c')]
#[AsEntity('mnt-by'), AsEntity('mnt-ref')]
class Mntner extends Entity implements Secondary
{
    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->create('mntner', Presence::primary_key, Repeat::single);
        $this->create('descr', Presence::optional, Repeat::multiple);
        $this->create('org', Presence::optional, Repeat::multiple);
        $this->create('admin-c', Presence::mandatory, Repeat::multiple);
        $this->create('tech-c', Presence::optional, Repeat::multiple);
        $this->create('upd-to', Presence::mandatory, Repeat::multiple);
        $this->create('mnt-nfy', Presence::optional, Repeat::multiple);
        $this->create('auth', Presence::mandatory, Repeat::multiple);
        $this->create('remarks', Presence::optional, Repeat::multiple);
        $this->create('notify', Presence::optional, Repeat::multiple);
        $this->create('mnt-by', Presence::mandatory, Repeat::multiple);
        $this->create('mnt-ref', Presence::optional, Repeat::multiple);
        $this->create('created', Presence::generated, Repeat::single);
        $this->create('last-modified', Presence::generated, Repeat::single);
        $this->create('source', Presence::mandatory, Repeat::single);
    }
}
