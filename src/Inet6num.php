<?php
// Inet6num.php

namespace Dormilich\RIPE;

use Dormilich\RPSL\AbstractObject;
use Dormilich\RPSL\AttributeInterface as Attr;

class Inet6num extends AbstractObject
{
    /**
     * The version of the RIPE DB used for attribute definitions.
     */
    const VERSION = '1.92';

    /**
     * Defines attributes for the INET6NUM RIPE object. 
     * 
     * @return void
     */
    protected function configure()
    {
        $this->define( 'inet6num', Attr::MANDATORY, Attr::SINGLE );
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
        $this->define( 'assignment-size', Attr::OPTIONAL, Attr::SINGLE );
        $this->define( 'remarks', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'notify', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-by', Attr::MANDATORY, Attr::MULTIPLE );
        $this->define( 'mnt-lower', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-routes', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-domains', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'mnt-irt', Attr::OPTIONAL, Attr::MULTIPLE );
        $this->define( 'source', Attr::MANDATORY, Attr::SINGLE );

        $this->generated( 'created', Attr::SINGLE );
        $this->generated( 'last-modified', Attr::SINGLE );
    }
}

/*
 * The allowed values for the 'status' attribute:
 * 
 * ‘ALLOCATED-BY-RIR’ 
 *      This is mostly used to identify blocks of addresses for which the RIPE 
 *      NCC is administratively responsible and allocations made to members by 
 *      the RIPE NCC.
 * ‘ALLOCATED-BY-LIR’ 
 *      This is equivalent to the inetnum status ‘SUB-ALLOCATED PA’. A member 
 *      can sub-allocate part of an allocation to another organisation. The 
 *      other organisation may take over some of the management of this 
 *      sub-allocation. However, the RIPE NCC member is still responsible for 
 *      the whole of their registered resources, even if some parts of it have 
 *      been sub-allocated to another organisation. Provisions have been built 
 *      in to the RIPE Database software to ensure that the member is always 
 *      technically in control of their allocated address space.
 *        With the inet6num object there is no equivalent to the inetnum 
 *      ‘LIR-PARTITIONED’ status values allowing partitioning of an allocation 
 *      by a member for internal business reasons.
 * ‘AGGREGATED-BY-LIR’ 
 *      With IPv6, it is not necessary to document each individual End User 
 *      assignment in the RIPE Database. If you have a group of End Users 
 *      who all require blocks of addresses of the same size, say a /56, 
 *      then you can create a large, single block with this status. 
 *      The “assignment-size:” attribute specifies the size of the End User 
 *      blocks. All assignments made from this block must have that size. 
 *      It is possible to have two levels of ‘AGGREGATED-BY-LIR’.
 * ‘ASSIGNED’ 
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
 */
