<?php declare(strict_types=1);

namespace Dormilich\RIPE\Entity;

use Dormilich\RIPE\Secondary;
use Dormilich\RPSL\Attribute\Presence;
use Dormilich\RPSL\Attribute\Repeat;
use Dormilich\RPSL\Entity;

/**
 * The organisation object provides information about an organisation that has
 * registered an Internet resource in the RIPE Database. This may be a company,
 * non-profit group or individual. It was introduced as a means to link together
 * all of the human and Internet resources related to one organisation.
 * This object is the central starting point for managing data in the RIPE Database.
 * All your other objects are related to this object. If you manage any aspect of
 * any resource then you should have an organisation object so that other people
 * know who you are, what you maintain and how to contact you.
 * The organisation object should only contain business information. Even if the
 * organisation is an individual, it should not include any personal information.
 *
 * @link https://apps.db.ripe.net/docs/RPSL-Object-Types/Descriptions-of-Secondary-Objects/#description-of-the-organisation-object
 * @version 1.113
 */
class Organisation extends Entity implements Secondary
{
    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->create('organisation', Presence::primary_key, Repeat::single);
        $this->create('org-name', Presence::mandatory, Repeat::single);
        $this->create('org-type', Presence::mandatory, Repeat::single);
        $this->create('descr', Presence::optional, Repeat::multiple);
        $this->create('remarks', Presence::optional, Repeat::multiple);
        $this->create('address', Presence::mandatory, Repeat::multiple);
        $this->create('country', Presence::optional, Repeat::single);
        $this->create('phone', Presence::optional, Repeat::multiple);
        $this->create('fax-no', Presence::optional, Repeat::multiple);
        $this->create('e-mail', Presence::mandatory, Repeat::multiple);
        $this->create('geoloc', Presence::optional, Repeat::single);
        $this->create('language', Presence::optional, Repeat::multiple);
        $this->create('org', Presence::optional, Repeat::multiple);
        $this->create('admin-c', Presence::optional, Repeat::multiple);
        $this->create('tech-c', Presence::optional, Repeat::multiple);
        $this->create('abuse-c', Presence::optional, Repeat::single);
        $this->create('ref-nfy', Presence::optional, Repeat::multiple);
        $this->create('mnt-ref', Presence::mandatory, Repeat::multiple);
        $this->create('notify', Presence::optional, Repeat::multiple);
        $this->create('mnt-by', Presence::mandatory, Repeat::multiple);
        $this->create('created', Presence::generated, Repeat::single);
        $this->create('last-modified', Presence::generated, Repeat::single);
        $this->create('source', Presence::mandatory, Repeat::single);
    }
}
