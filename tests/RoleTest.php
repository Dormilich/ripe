<?php

use Dormilich\RIPE;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{
    public function testRoleDefaultName()
    {
        $obj = new RIPE\Role;

        $this->assertSame( 'AUTO-1', $obj->get( 'role' ) );
    }

    public function testPersonDefaultName()
    {
        $obj = new RIPE\Person;

        $this->assertSame( 'AUTO-1', $obj->get( 'person' ) );
    }
}
