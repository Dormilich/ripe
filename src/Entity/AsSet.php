<?php declare(strict_types=1);

namespace Dormilich\RIPE\Entity;

use Dormilich\RIPE\Factory\AsDatetime;
use Dormilich\RIPE\Factory\AsEntity;
use Dormilich\RIPE\Primary;
use Dormilich\RPSL\Attribute\Presence;
use Dormilich\RPSL\Attribute\Repeat;
use Dormilich\RPSL\Entity;

/**
 * To specify policies, it is often useful to define sets of objects. An as-set
 * object forms a set of AS Numbers that can be referenced in many of the places
 * where an AS Number reference can be used. Sets can be built with hierarchical
 * names and can also include direct references to other sets.
 *
 * @link https://apps.db.ripe.net/docs/RPSL-Object-Types/Descriptions-of-Primary-Objects/#description-of-the-as-set-object
 * @version 1.113
 */
#[AsDatetime('created'), AsDatetime('last-modified')]
#[AsEntity('org')]
#[AsEntity('admin-c'), AsEntity('tech-c')]
#[AsEntity('mnt-by'), AsEntity('mnt-lower')]
class AsSet extends Entity implements Primary
{
    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->create('as-set', Presence::primary_key, Repeat::single);
        $this->create('descr', Presence::optional, Repeat::multiple);
        $this->create('members', Presence::optional, Repeat::multiple);
        $this->create('mbrs-by-ref', Presence::optional, Repeat::multiple);
        $this->create('remarks', Presence::optional, Repeat::multiple);
        $this->create('org', Presence::optional, Repeat::multiple);
        $this->create('tech-c', Presence::mandatory, Repeat::multiple);
        $this->create('admin-c', Presence::mandatory, Repeat::multiple);
        $this->create('notify', Presence::optional, Repeat::multiple);
        $this->create('mnt-by', Presence::mandatory, Repeat::multiple);
        $this->create('mnt-lower', Presence::optional, Repeat::multiple);
        $this->create('created', Presence::generated, Repeat::single);
        $this->create('last-modified', Presence::generated, Repeat::single);
        $this->create('source', Presence::mandatory, Repeat::single);
    }
}
