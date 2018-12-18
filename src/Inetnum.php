<?php
// Inetnum.php

namespace Dormilich\RIPE;

use Dormilich\Http\RangeInterface;
use Dormilich\RPSL\AbstractObject;
use Dormilich\RPSL\AttributeInterface as Attr;

class Inetnum extends AbstractObject
{
    /**
     * The version of the RIPE DB used for attribute definitions.
     */
    const VERSION = '1.92';

    /**
     * Defines attributes for the INETNUM RIPE object. 
     * 
     * @return void
     */
    protected function configure()
    {
        $this->define( 'inetnum', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'netname', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'descr', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'country', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'geoloc', Attr::OPTIONAL, Attr::SINGLE );
        $this->define( 'language', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'org', Attr::OPTIONAL, Attr::SINGLE );
        $this->define( 'sponsoring-org', Attr::OPTIONAL, Attr::SINGLE );
        $this->define( 'admin-c', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'tech-c', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'abuse-c', Attr::OPTIONAL, Attr::SINGLE );
        $this->define( 'status', Attr::MANDATORY, Attr::SINGLE );
        $this->define( 'remarks', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'notify', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-by', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'mnt-lower', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-domains', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-routes', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-irt', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'source', Attr::MANDATORY, Attr::SINGLE );

        $this->generated( 'created', Attr::SINGLE );
        $this->generated( 'last-modified', Attr::SINGLE );
    }

    /**
     * Supported input formats:
     *  - IP range string (IP address - space - hyphen - space - IP address)
     *  - IP address & IP address
     *  - CIDR
     * 
     * @param mixed $address IP range, CIDR, or IP string/object.
     * @param mixed $value IP string/object.
     * @return array
     */
    protected function keysFromInput( $range, $ip = null )
    {
        $range = $this->getIPRange( $range, $ip );
        return parent::keysFromInput( $range );
    }

    /**
     * Convert the various input formats to an IP range string. If the input 
     * fails any validation, the address parameter is returned unchanged.
     * 
     * @param mixed $address IP range, CIDR, or IP string/object.
     * @param mixed $value CIDR prefix or IP string/object.
     * @return string IP range string.
     */
    private function getIPRange( $range, $ip )
    {
        if ( $range instanceof RangeInterface ) {
            return sprintf( '%s - %s', $range->getFirstIP(), $range->getLastIP() );
        }
        // check for range
        if ( strpos( $range, '-' ) !== false ) {
            return $range;
        }
        // check for CIDR
        if ( strpos( $range, '/' ) !== false )  {
            return $this->fromCIDR( $range );
        }
        // try input as IP
        if ( $ip ) {
            return $this->fromIP( $range, $ip );
        }

        return (string) $range;
    }

    /**
     * Convert a CIDR into an IP range.
     * 
     * @param string $cidr 
     * @return string
     */
    private function fromCIDR( $cidr )
    {
        list( $ip, $prefix ) = explode( '/', (string) $cidr, 2 );
        $ip_num = ip2long( $ip );

        if ( false === $ip_num or ! ctype_digit( $prefix ) or $prefix < 0 or $prefix > 32 ) {
            return (string) $cidr;
        }

        $netsize = 1 << ( 32 - $prefix );
        $start_num = $ip_num - ( $ip_num % $netsize );
        $end_num = $start_num + $netsize - 1;

        return long2ip( $start_num ) . ' - ' . long2ip( $end_num );
    }

    /**
     * Convert two IPs into an IP range.
     * 
     * @param string $first 
     * @param string $last 
     * @return string
     */
    private function fromIP( $first, $last )
    {
        $start_num = ip2long( (string) $first );
        $end_num   = ip2long( (string) $last );

        if ( false === $start_num or false === $end_num ) {
            return (string) $first;
        }

        if ( $start_num < $end_num ) {
            $range = long2ip( $start_num ) . ' - ' . long2ip( $end_num );
        } 
        elseif ( $start_num > $end_num ) {
            $range = long2ip( $end_num ) . ' - ' . long2ip( $start_num );
        }
        else {
            $range = long2ip( $start_num );
        }

        return $range;
    }
}
/*
 * The allowed values for the 'status' attribute:
 * 
 * ‘ALLOCATED UNSPECIFIED’ 
 *      This is mostly used to identify blocks of addresses for which the 
 *      RIPE NCC is administratively responsible. Historically, a small 
 *      number of allocations made to members have this status also.
 * ‘ALLOCATED PA’ 
 *      These are allocations made to members by the RIPE NCC.
 * ‘ALLOCATED PI’ 
 *      This is mostly used to identify blocks of addresses from which the 
 *      RIPE NCC makes assignments to end users. Historically, a small number 
 *      of allocations made to members have this status also.
 * ‘LIR-PARTITIONED PA’ 
 *      This is to allow partitioning of an allocation by a member for 
 *      internal business reasons.
 * ‘LIR-PARTITIONED PI’ 
 *      This is to allow partitioning of an allocation by a member for 
 *      internal business reasons.
 * ‘SUB-ALLOCATED PA’ 
 *      A member can sub-allocate a part of an allocation to another 
 *      organisation. The other organisation may take over some of the 
 *      management of this sub-allocation. However, the RIPE NCC member 
 *      is still responsible for the whole of their registered resources, 
 *      even if parts of it have been sub-allocated. Provisions have been 
 *      built in to the RIPE Database software to ensure that the member 
 *      is always technically in control of their allocated address space.
 * ‘ASSIGNED PA’ 
 *      These are assignments made by a member from their allocations to an 
 *      End User.
 * ‘ASSIGNED PI’ 
 *      These are assignments made by the RIPE NCC directly to an End User. 
 *      In most cases, there is a member acting as the sponsoring organisation 
 *      who handles the administrative processes on behalf of the End User. 
 *      The sponsoring organisation may also manage the resource and related 
 *      objects in the RIPE Database for the End User.
 * ‘ASSIGNED ANYCAST’ 
 *      This address space has been assigned for use in TLD anycast networks.
 * ‘LEGACY’ 
 *      These are resources that were allocated to users before the RIPE NCC 
 *      was set up.
 * ‘NOT-SET’ 
 *      There are some very old objects in the RIPE Database where the status 
 *      was unknown when the “status:” attribute was introduced. When it became 
 *      a mandatory attribute, these objects were given this status value. 
 *      When contact is made with the organisations holding these resources, 
 *      the real status value will be determined. 
 */
