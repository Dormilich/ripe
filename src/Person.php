<?php
// Person.php

namespace Dormilich\RIPE;

use Dormilich\RPSL\AbstractObject;
use Dormilich\RPSL\AttributeInterface as Attr;

/**
 * Valid handle names are:
 *  - AUTO-1
 *  - AUTO-1{[A-Z]+}
 *  - {[A-Z]+}
 *  - {[A-Z]+}-RIPE
 *  - {[A-Z]+}-{2-letter country code}
 */
class Person extends AbstractObject
{
    /**
     * The version of the RIPE DB used for attribute definitions.
     */
    const VERSION = '1.92';

    /**
     * Create a PERSON RIPE object.
     * 
     * @param string $value NIC handle. If not specified an auto-handle is used.
     * @return self
     */
    public function __construct( $value = 'AUTO-1' )
    {
        parent::__construct( $value );
    }

    /**
     * Defines attributes for the PERSON RIPE object. 
     * 
     * @return void
     */
    protected function configure()
    {
        $this->define( 'person', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'address', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'phone', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'fax-no', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'e-mail', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'org', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'nic-hdl', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'remarks', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'notify', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-by', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'source', Attr::MANDATORY, Attr::SINGLE );

        $this->generated( 'created', Attr::SINGLE );
        $this->generated( 'last-modified', Attr::SINGLE );
    }

    /**
     * @inheritDoc
     */
    protected function keysFromInput( $value )
    {
        return [ 'nic-hdl' => $value ];
    }
}
