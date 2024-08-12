<?php

namespace Dormilich\RIPE\Tests\Entity;

use Dormilich\RIPE\Entity\Route;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

#[CoversClass(Route::class)]
class RouteTest extends TestCase
{
    #[Test, TestDox('create primary keys from a handle')]
    public function read_handle()
    {
        $handle = '203.0.113.0/24AS65544';
        $route = new Route($handle);

        $this->assertSame($handle, $route->getHandle());
        $this->assertSame('203.0.113.0/24', $route->get('route'));
        $this->assertSame('AS65544', $route->get('origin'));
    }

    #[Test, TestDox('create primary keys without ASN is ignored')]
    public function only_network_fails()
    {
        $route = new Route('203.0.113.0/24');

        $this->assertNull($route->getHandle());
        $this->assertTrue($route->attr('route')->isEmpty(), 'route is not empty');
        $this->assertTrue($route->attr('origin')->isEmpty(), 'origin is not empty');
    }

    #[Test, TestDox('create primary keys without network is ignored')]
    public function only_asn_fails()
    {
        $route = new Route('AS65544');

        $this->assertNull($route->getHandle());
        $this->assertTrue($route->attr('route')->isEmpty(), 'route is not empty');
        $this->assertTrue($route->attr('origin')->isEmpty(), 'origin is not empty');
    }

    #[Test, TestDox('create primary keys from IPv6 is ignored')]
    public function ipv6_network_fails()
    {
        $route = new Route('2001:db8:d06:f00d::/64AS65544');

        $this->assertNull($route->getHandle());
        $this->assertTrue($route->attr('route')->isEmpty(), 'route is not empty');
        $this->assertTrue($route->attr('origin')->isEmpty(), 'origin is not empty');
    }
}
