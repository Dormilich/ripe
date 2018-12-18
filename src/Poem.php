<?php
// Poem.php

namespace Dormilich\RIPE;

use Dormilich\RPSL\AbstractObject;
use Dormilich\RPSL\AttributeInterface as Attr;

/**
 * Forms may be one of: FORM-HAIKU, FORM-LIMERICK, FORM-SONNET-ENGLISH, and FORM-PROSE
 */
class Poem extends AbstractObject
{
    /**
     * The version of the RIPE DB used for attribute definitions.
     */
    const VERSION = '1.92';

    /**
     * Defines attributes for the POEM RIPE object. 
     * 
     * @return void
     */
    protected function configure()
    {
        $this->define( 'poem', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'descr', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'form', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'text', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'author', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'remarks', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'notify', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-by', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'source', Attr::MANDATORY, Attr::SINGLE );

        $this->generated( 'created', Attr::SINGLE );
        $this->generated( 'last-modified', Attr::SINGLE );
    }
}
