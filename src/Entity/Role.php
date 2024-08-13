<?php declare(strict_types=1);

namespace Dormilich\RIPE\Entity;

use Dormilich\RIPE\ContactInterface;
use Dormilich\RIPE\Factory\AsDatetime;
use Dormilich\RIPE\Factory\AsEntity;
use Dormilich\RIPE\Secondary;
use Dormilich\RPSL\Attribute\Presence;
use Dormilich\RPSL\Attribute\Repeat;
use Dormilich\RPSL\Entity;

/**
 * A role object is similar to a person object. However, instead of describing a
 * single person, it describes a role performed by one or more people. This might
 * be a help desk, network monitoring centre, team of system administrators, etc.
 * A role object is useful since often a person performing a specific function
 * may change while the role itself remains.
 * The role object should only include business information about the role. It
 * should not contain any personal information, although it can reference person
 * objects. The original intention was that the role object should be used in
 * every other object where contacts are referenced. The person object was only
 * intended to be referenced by the role object. However, business rules were
 * never built into the software to enforce this. As a consequence, the person
 * and role objects have been used inter changeably in almost any situation
 * where contacts are referenced.
 *
 * @link https://apps.db.ripe.net/docs/RPSL-Object-Types/Descriptions-of-Secondary-Objects/#description-of-the-role-object
 * @version 1.113
 */
#[AsDatetime('created'), AsDatetime('last-modified')]
#[AsEntity('org')]
#[AsEntity('admin-c'), AsEntity('tech-c')]
#[AsEntity('mnt-by'), AsEntity('mnt-ref')]
class Role extends Entity implements Secondary, ContactInterface
{
    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->create('role', Presence::mandatory, Repeat::single);
        $this->create('address', Presence::mandatory, Repeat::multiple);
        $this->create('phone', Presence::optional, Repeat::multiple);
        $this->create('fax-no', Presence::optional, Repeat::multiple);
        $this->create('e-mail', Presence::mandatory, Repeat::multiple);
        $this->create('org', Presence::optional, Repeat::multiple);
        $this->create('admin-c', Presence::optional, Repeat::multiple);
        $this->create('tech-c', Presence::optional, Repeat::multiple);
        $this->create('nic-hdl', Presence::primary_key, Repeat::single);
        $this->create('remarks', Presence::optional, Repeat::multiple);
        $this->create('notify', Presence::optional, Repeat::multiple);
        $this->create('abuse-mailbox', Presence::optional, Repeat::single);
        $this->create('mnt-by', Presence::mandatory, Repeat::multiple);
        $this->create('mnt-ref', Presence::optional, Repeat::multiple);
        $this->create('created', Presence::generated, Repeat::single);
        $this->create('last-modified', Presence::generated, Repeat::single);
        $this->create('source', Presence::mandatory, Repeat::single);
    }
}
