<?php declare(strict_types=1);

namespace Dormilich\RIPE\Entity;

use Dormilich\RIPE\Factory\AsDatetime;
use Dormilich\RIPE\Factory\AsEntity;
use Dormilich\RIPE\Secondary;
use Dormilich\RPSL\Attribute\Presence;
use Dormilich\RPSL\Attribute\Repeat;
use Dormilich\RPSL\Entity;

/**
 * A poetic-form object defines the supported poem types. A new 'poetic form'
 * must be approved by the community 'style council'.
 *
 * @link https://apps.db.ripe.net/docs/RPSL-Object-Types/Descriptions-of-Secondary-Objects/#description-of-the-poetic-form-object
 * @version 1.113
 */
#[AsDatetime('created'), AsDatetime('last-modified')]
#[AsEntity('admin-c')]
#[AsEntity('mnt-by')]
class PoeticForm extends Entity implements Secondary
{
    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->create('poetic-form', Presence::primary_key, Repeat::single);
        $this->create('descr', Presence::optional, Repeat::multiple);
        $this->create('admin-c', Presence::mandatory, Repeat::multiple);
        $this->create('remarks', Presence::optional, Repeat::multiple);
        $this->create('notify', Presence::optional, Repeat::multiple);
        $this->create('mnt-by', Presence::mandatory, Repeat::single);
        $this->create('created', Presence::generated, Repeat::single);
        $this->create('last-modified', Presence::generated, Repeat::single);
        $this->create('source', Presence::mandatory, Repeat::single);
    }
}
