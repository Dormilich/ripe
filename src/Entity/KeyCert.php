<?php declare(strict_types=1);

namespace Dormilich\RIPE\Entity;

use Dormilich\RIPE\Secondary;
use Dormilich\RPSL\Attribute\Presence;
use Dormilich\RPSL\Attribute\Repeat;
use Dormilich\RPSL\Entity;

/**
 * A key-cert object holds a public key certificate, available by querying the
 * RIPE Database. Anyone who needs to use authorisation in the RIPE Database and
 * who has a private key can store their public key in a key-cert object. It is
 * used with the mntner and irt objects. You cannot create a public/private key
 * pair using the RIPE Database software. You must use some external software to
 * create your keys and then copy the certificate data into the key-cert object.
 *
 * @link https://apps.db.ripe.net/docs/RPSL-Object-Types/Descriptions-of-Secondary-Objects/#description-of-the-key-cert-object
 * @version 1.113
 */
class KeyCert extends Entity implements Secondary
{
    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->create('key-cert', Presence::primary_key, Repeat::single);
        $this->create('method', Presence::generated, Repeat::single);
        $this->create('owner', Presence::generated, Repeat::multiple);
        $this->create('fingerpr', Presence::generated, Repeat::single);
        $this->create('certif', Presence::mandatory, Repeat::multiple);
        $this->create('org', Presence::optional, Repeat::multiple);
        $this->create('remarks', Presence::optional, Repeat::multiple);
        $this->create('notify', Presence::optional, Repeat::multiple);
        $this->create('admin-c', Presence::optional, Repeat::multiple);
        $this->create('tech-c', Presence::optional, Repeat::multiple);
        $this->create('mnt-by', Presence::mandatory, Repeat::multiple);
        $this->create('created', Presence::generated, Repeat::single);
        $this->create('last-modified', Presence::generated, Repeat::single);
        $this->create('source', Presence::mandatory, Repeat::single);
    }
}
