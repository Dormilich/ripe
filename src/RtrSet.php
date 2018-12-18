<?php
// RtrSet.php

namespace Dormilich\RIPE;

use Dormilich\RPSL\AbstractObject;
use Dormilich\RPSL\AttributeInterface as Attr;

class RtrSet extends AbstractObject
{
    /**
     * The version of the RIPE DB used for attribute definitions.
     */
    const VERSION = '1.92';

    /**
     * Defines attributes for the RTR-SET RIPE object. 
     * 
     * @return void
     */
    protected function configure()
    {
        $this->define( 'rtr-set', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'descr', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'members', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mp-members', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mbrs-by-ref', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'remarks', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'org', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'tech-c', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'admin-c', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'notify', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-by', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'mnt-lower', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'source', Attr::MANDATORY, Attr::SINGLE );

        $this->generated( 'created', Attr::SINGLE );
        $this->generated( 'last-modified', Attr::SINGLE );
    }
}
