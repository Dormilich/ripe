<?php
// KeyCert.php

namespace Dormilich\RIPE;

use Dormilich\RPSL\AbstractObject;
use Dormilich\RPSL\AttributeInterface as Attr;

/**
 * Be aware that the 'method', 'owner' and 'fingerpr' attributes 
 * must not be set/updated/deleted by the user.
 */
class KeyCert extends AbstractObject
{
    /**
     * The version of the RIPE DB used for attribute definitions.
     */
    const VERSION = '1.92';

    /**
     * Defines attributes for the KEY-CERT RIPE object. 
     * 
     * @return void
     */
    protected function configure()
    {
        $this->define( 'key-cert', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'certif', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'org', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'remarks', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'notify', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'admin-c', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'tech-c', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-by', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'source', Attr::MANDATORY, Attr::SINGLE );

        $this->generated( 'method', Attr::SINGLE );
        $this->generated( 'owner', Attr::MULTIPLE );
        $this->generated( 'fingerpr', Attr::SINGLE );
        $this->generated( 'created', Attr::SINGLE );
        $this->generated( 'last-modified', Attr::SINGLE );
    }
}
