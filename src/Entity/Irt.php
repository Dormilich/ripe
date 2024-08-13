<?php declare(strict_types=1);

namespace Dormilich\RIPE\Entity;

use Dormilich\RIPE\Factory\AsDatetime;
use Dormilich\RIPE\Factory\AsEntity;
use Dormilich\RIPE\Secondary;
use Dormilich\RPSL\Attribute\Presence;
use Dormilich\RPSL\Attribute\Repeat;
use Dormilich\RPSL\Entity;

/**
 * The irt object was introduced to represent a Computer Security Incident Response
 * Team (CSIRT). This object includes security information for use by CSIRT teams
 * as they communicate with each other.
 *
 * @link https://apps.db.ripe.net/docs/RPSL-Object-Types/Descriptions-of-Secondary-Objects/#description-of-the-irt-object
 * @version 1.113
 */
#[AsDatetime('created'), AsDatetime('last-modified')]
#[AsEntity('org')]
#[AsEntity('admin-c'), AsEntity('tech-c')]
#[AsEntity('mnt-by'), AsEntity('mnt-ref')]
class Irt extends Entity implements Secondary
{
    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->create('irt', Presence::primary_key, Repeat::single);
        $this->create('address', Presence::mandatory, Repeat::multiple);
        $this->create('phone', Presence::optional, Repeat::multiple);
        $this->create('fax-no', Presence::optional, Repeat::multiple);
        $this->create('e-mail', Presence::mandatory, Repeat::multiple);
        $this->create('signature', Presence::optional, Repeat::multiple);
        $this->create('encryption', Presence::optional, Repeat::multiple);
        $this->create('org', Presence::optional, Repeat::multiple);
        $this->create('admin-c', Presence::mandatory, Repeat::multiple);
        $this->create('tech-c', Presence::mandatory, Repeat::multiple);
        $this->create('auth', Presence::mandatory, Repeat::multiple);
        $this->create('remarks', Presence::optional, Repeat::multiple);
        $this->create('irt-nfy', Presence::optional, Repeat::multiple);
        $this->create('notify', Presence::optional, Repeat::multiple);
        $this->create('mnt-by', Presence::mandatory, Repeat::multiple);
        $this->create('mnt-ref', Presence::optional, Repeat::multiple);
        $this->create('created', Presence::generated, Repeat::single);
        $this->create('last-modified', Presence::generated, Repeat::single);
        $this->create('source', Presence::mandatory, Repeat::single);
    }
}
