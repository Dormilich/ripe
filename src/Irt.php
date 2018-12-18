<?php
// Irt.php

namespace Dormilich\RIPE;

use Dormilich\RPSL\AbstractObject;
use Dormilich\RPSL\AttributeInterface as Attr;

class Irt extends AbstractObject
{
    /**
     * The version of the RIPE DB used for attribute definitions.
     */
    const VERSION = '1.92';

    /**
     * Defines attributes for the IRT RIPE object. 
     * 
     * @return void
     */
    protected function configure()
    {
        $this->define( 'irt', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'address', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'phone', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'fax-no', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'e-mail', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'signature', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'encryption', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'org', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'admin-c', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'tech-c', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'auth', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'remarks', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'irt-nfy', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'notify', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-by', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'source', Attr::MANDATORY, Attr::SINGLE );

        $this->generated( 'created', Attr::SINGLE );
        $this->generated( 'last-modified', Attr::SINGLE );
    }
}
