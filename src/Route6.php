<?php
// Route6.php

namespace Dormilich\RIPE;

use Dormilich\RPSL\AbstractObject;
use Dormilich\RPSL\AttributeInterface as Attr;

class Route6 extends AbstractObject
{
    /**
     * The version of the RIPE DB used for attribute definitions.
     */
    const VERSION = '1.92';

    /**
     * Defines attributes for the ROUTE6 RIPE object. 
     * 
     * @return void
     */
    protected function configure()
    {
        $this->define( 'route6', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'descr', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'origin', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'pingable', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'ping-hdl', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'holes', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'org', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'member-of', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'inject', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'aggr-mtd', Attr::OPTIONAL, Attr::SINGLE );
        $this->define( 'aggr-bndry', Attr::OPTIONAL, Attr::SINGLE );
        $this->define( 'export-comps', Attr::OPTIONAL, Attr::SINGLE );
        $this->define( 'components', Attr::OPTIONAL, Attr::SINGLE );
        $this->define( 'remarks', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'notify', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-lower', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-routes', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-by', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'source', Attr::MANDATORY, Attr::SINGLE );

        $this->generated( 'created', Attr::SINGLE );
        $this->generated( 'last-modified', Attr::SINGLE );
    }

    /**
     * Parse input for a composite primary key.
     * 
     * @param string $value Route with optional Aut-Num.
     * @return array
     */
    protected function keysFromInput( $route, $origin = NULL )
    {
        if ( $origin ) {
            return $this->fromArgs( trim( $route ), trim( $origin ) );
        } else {
            return $this->fromHandle( (string) $route );
        }
    }

    /**
     * Get keys from input arguments.
     * 
     * @param string $route 
     * @param string $origin 
     * @return array
     */
    private function fromArgs( $route, $origin )
    {
        if ( strpos( $origin, 'AS' ) === 0 ) {
            return [ 'route6' => $route, 'origin' => $origin, ];
        } else {
            return [ 'route6' => $origin, 'origin' => $route, ];
        }
    }

    /**
     * Separate stringified primary key (e.g. "10.0.0.0/24AS012") into its components.
     * 
     * @param string $value 
     * @return array
     */
    private function fromHandle( $value )
    {
        $key[ 'origin' ] = NULL;

        if ( preg_match( '/AS\d+/', $value, $match ) === 1 ) {
            $key[ 'origin' ] = $match[ 0 ];
            $value = str_replace( $match[ 0 ], '', $value );
        }

        $key[ 'route6' ] = trim( $value );

        return array_reverse( $key );
    }
}
