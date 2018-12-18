<?php
// Organisation.php

namespace Dormilich\RIPE;

use Dormilich\RPSL\AbstractObject;
use Dormilich\RPSL\AttributeInterface as Attr;

class Organisation extends AbstractObject
{
    /**
     * The version of the RIPE DB used for attribute definitions.
     */
    const VERSION = '1.92';

    /**
     * Create an ORGANISATION RIPE object.
     * 
     * @param string $value A letter combination appended to the Auto-ID.
     * @return self
     */
    public function __construct( $value = 'AUTO-1' )
    {
        parent::__construct( $value );
    }

    /**
     * Defines attributes for the ORGANISATION RIPE object. 
     * 
     * @return void
     */
    protected function configure()
    {
        $this->define( 'organisation', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'org-name', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'org-type', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'descr', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'remarks', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'address', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'phone', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'fax-no', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'e-mail', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'geoloc', Attr::OPTIONAL, Attr::SINGLE );
        $this->define( 'language', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'org', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'admin-c', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'tech-c', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'abuse-c', Attr::OPTIONAL, Attr::SINGLE );
        $this->define( 'ref-nfy', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-ref', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'notify', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-by', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'source', Attr::MANDATORY, Attr::SINGLE );

        $this->generated( 'created', Attr::SINGLE );
        $this->generated( 'last-modified', Attr::SINGLE );
    }
}

/**
 * The allowed values for the 'org-type' attribute:
 * 
 * Users can only create organisation objects with the type ‘OTHER’. 
 * The rest of the values can only be set by the RIPE NCC.
 *
 * 'IANA'
 *      Only used for Internet Assigned Numbers Authority
 * 'RIR'
 *      Only used for the five Regional Internet Registries
 * 'NIR'
 *      This is for National Internet Registries (there are no NIRs in the 
 *      RIPE NCC service region, but it is used by APNIC)
 * 'LIR'
 *      This represents all the Local Internet Registries (the RIPE NCC members)
 * 'WHITEPAGES'
 *      A little-used historical idea for people who have a ‘significant’ presence 
 *      in the industry but who don’t manage any resources in the RIPE Database.
 * 'DIRECT_ASSIGNMENT'
 *      Used for organisations who have a direct contract with RIPE NCC
 * 'OTHER'
 *      This represents all organisations that do not fit any of the above categories.
 */
