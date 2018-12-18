<?php

use Dormilich\RIPE;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{
    public function testRoleDefaultName()
    {
        $obj = new RIPE\Role;

        $this->assertNull( $obj->get( 'role' ) );
        $this->assertSame( 'AUTO-1', $obj->getHandle() );
    }

    public function testPersonDefaultName()
    {
        $obj = new RIPE\Person;

        $this->assertNull( $obj->get( 'person' ) );
        $this->assertSame( 'AUTO-1', $obj->getHandle() );
    }
}
