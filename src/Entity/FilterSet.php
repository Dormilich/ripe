<?php declare(strict_types=1);

namespace Dormilich\RIPE\Entity;

use Dormilich\RIPE\Factory\AsDatetime;
use Dormilich\RIPE\Factory\AsEntity;
use Dormilich\RIPE\Primary;
use Dormilich\RPSL\Attribute\Presence;
use Dormilich\RPSL\Attribute\Repeat;
use Dormilich\RPSL\Entity;

/**
 * To specify routing policies, it is often useful to define sets of objects.
 * A filter-set object defines a set of routes that match the criteria that you
 * specify in your 'filter' – in other words, it filters out the routes that you
 * do not want to see. The policy filter can match routes using any BGP path
 * attribute, such as the destination address prefix, AS-path, or community attributes.
 *
 * @link https://apps.db.ripe.net/docs/RPSL-Object-Types/Descriptions-of-Primary-Objects/#description-of-the-filter-set-object
 * @version 1.113
 */
#[AsDatetime('created'), AsDatetime('last-modified')]
#[AsEntity('org')]
#[AsEntity('admin-c'), AsEntity('tech-c')]
#[AsEntity('mnt-by'), AsEntity('mnt-lower')]
class FilterSet extends Entity implements Primary
{
    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->create('filter-set', Presence::primary_key, Repeat::single);
        $this->create('descr', Presence::optional, Repeat::multiple);
        $this->create('filter', Presence::optional, Repeat::single);
        $this->create('mp-filter', Presence::optional, Repeat::single);
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
