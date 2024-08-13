<?php declare(strict_types=1);

namespace Dormilich\RIPE\Entity;

use Dormilich\RIPE\Factory\AsDatetime;
use Dormilich\RIPE\Factory\AsEntity;
use Dormilich\RIPE\Secondary;
use Dormilich\RPSL\Attribute\Presence;
use Dormilich\RPSL\Attribute\Repeat;
use Dormilich\RPSL\Entity;

/**
 * An as-block object delegates a range of AS Numbers to a given RIR. Only the
 * RIPE Database Administrators can create as-block objects. The set of as-block
 * objects covers the full range of 16-bit and 32-bit AS Numbers. These objects
 * prevent anyone other than the RIPE Database administrators from creating
 * aut-num objects in the RIPE Database for AS Numbers that are administered by
 * the RIPE NCC. The authorisation is set up so that anyone can create aut-num
 * objects in the RIPE Database as copies of AS Numbers administered by other RIRs.
 *
 * @link https://apps.db.ripe.net/docs/RPSL-Object-Types/Descriptions-of-Secondary-Objects/#description-of-the-as-block-object
 * @version 1.113
 */
#[AsDatetime('created'), AsDatetime('last-modified')]
#[AsEntity('mnt-by'), AsEntity('mnt-lower')]
class AsBlock extends Entity implements Secondary
{
    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->create('as-block', Presence::primary_key, Repeat::single);
        $this->create('descr', Presence::optional, Repeat::multiple);
        $this->create('remarks', Presence::optional, Repeat::multiple);
        $this->create('org', Presence::optional, Repeat::multiple);
        $this->create('notify', Presence::optional, Repeat::multiple);
        $this->create('mnt-by', Presence::mandatory, Repeat::multiple);
        $this->create('mnt-lower', Presence::optional, Repeat::multiple);
        $this->create('created', Presence::generated, Repeat::single);
        $this->create('last-modified', Presence::generated, Repeat::single);
        $this->create('source', Presence::mandatory, Repeat::single);
    }
}
