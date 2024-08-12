<?php declare(strict_types=1);

namespace Dormilich\RIPE\Entity;

use Dormilich\RIPE\ContactInterface;
use Dormilich\RIPE\Secondary;
use Dormilich\RPSL\Attribute\Presence;
use Dormilich\RPSL\Attribute\Repeat;
use Dormilich\RPSL\Entity;

/**
 * The person object provides information about a real person. The original
 * intention was that this should only be used for contacts responsible for
 * technical or administrative issues relating to Internet resources registered
 * in the RIPE Database. However, the business model used by many resource holders
 * is to also document End User customers who have been assigned a resource. One
 * of its purposes is defined as a contact database for people who manage resources.
 *
 * @link https://apps.db.ripe.net/docs/RPSL-Object-Types/Descriptions-of-Secondary-Objects/#description-of-the-person-object
 * @version 1.113
 */
class Person extends Entity implements Secondary, ContactInterface
{
    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->create('person', Presence::mandatory, Repeat::single);
        $this->create('address', Presence::mandatory, Repeat::multiple);
        $this->create('phone', Presence::mandatory, Repeat::multiple);
        $this->create('fax-no', Presence::optional, Repeat::multiple);
        $this->create('e-mail', Presence::optional, Repeat::multiple);
        $this->create('org', Presence::optional, Repeat::multiple);
        $this->create('nic-hdl', Presence::primary_key, Repeat::single);
        $this->create('remarks', Presence::optional, Repeat::multiple);
        $this->create('notify', Presence::optional, Repeat::multiple);
        $this->create('mnt-by', Presence::mandatory, Repeat::multiple);
        $this->create('mnt-ref', Presence::optional, Repeat::multiple);
        $this->create('created', Presence::generated, Repeat::single);
        $this->create('last-modified', Presence::generated, Repeat::single);
        $this->create('source', Presence::mandatory, Repeat::single);
    }
}
