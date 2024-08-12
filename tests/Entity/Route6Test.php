<?php

namespace Dormilich\RIPE\Tests\Entity;

use Dormilich\RIPE\Entity\Route6;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

#[CoversClass(Route6::class)]
class Route6Test extends TestCase
{
    #[Test, TestDox('create primary keys from a handle')]
    public function read_handle()
    {
        $handle = '2001:db8:d06:f00d::/64AS65544';
        $route = new Route6($handle);

        $this->assertSame($handle, $route->getHandle());
        $this->assertSame('2001:db8:d06:f00d::/64', $route->get('route6'));
        $this->assertSame('AS65544', $route->get('origin'));
    }

    #[Test, TestDox('create primary keys without ASN is ignored')]
    public function only_network_fails()
    {
        $route = new Route6('203.0.113.0/24');

        $this->assertNull($route->getHandle());
        $this->assertTrue($route->attr('route6')->isEmpty(), 'route6 is not empty');
        $this->assertTrue($route->attr('origin')->isEmpty(), 'origin is not empty');
    }

    #[Test, TestDox('create primary keys without network is ignored')]
    public function only_asn_fails()
    {
        $route = new Route6('AS65544');

        $this->assertNull($route->getHandle());
        $this->assertTrue($route->attr('route6')->isEmpty(), 'route6 is not empty');
        $this->assertTrue($route->attr('origin')->isEmpty(), 'origin is not empty');
    }

    #[Test, TestDox('create primary keys from IPv4 is ignored')]
    public function ipv4_network_fails()
    {
        $route = new Route6('203.0.113.0/24AS65544');

        $this->assertNull($route->getHandle());
        $this->assertTrue($route->attr('route6')->isEmpty(), 'route6 is not empty');
        $this->assertTrue($route->attr('origin')->isEmpty(), 'origin is not empty');
    }
}
