<?php
// AutNum.php

namespace Dormilich\RIPE;

use Dormilich\RPSL\AbstractObject;
use Dormilich\RPSL\AttributeInterface as Attr;

/**
 * Be aware that the 'sponsoring-org' and 'status' attributes 
 * must not be set/updated/deleted by the user.
 */
class AutNum extends AbstractObject
{
    /**
     * The version of the RIPE DB used for attribute definitions.
     */
    const VERSION = '1.92';

    /**
     * Defines attributes for the AUT-NUM RIPE object. 
     * 
     * @return void
     */
    protected function configure()
    {
        $this->define( 'aut-num', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'as-name', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'descr', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'member-of', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'import-via', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'import', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mp-import',  Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'export-via', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'export', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mp-export', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'default', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mp-default', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'remarks', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'org', Attr::OPTIONAL, Attr::SINGLE );
        $this->define( 'sponsoring-org', Attr::OPTIONAL, Attr::SINGLE );
        $this->define( 'admin-c', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'tech-c', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'abuse-c', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'notify', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-lower', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-by', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'source', Attr::MANDATORY, Attr::SINGLE );

        $this->generated( 'status', Attr::SINGLE );
        $this->generated( 'created', Attr::SINGLE );
        $this->generated( 'last-modified', Attr::SINGLE );
    }
}
