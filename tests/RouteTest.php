<?php

use Dormilich\RIPE;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    public function route4ArgumentsProvider()
    {
        return [
            [ '192.0.2.0/24', 'AS65536', ],
            [ 'AS65536', '192.0.2.0/24', ],
        ];
    }

    public function route6ArgumentsProvider()
    {
        return [
            [ '2001:db8:bec0:f94f/64', 'AS65536', ],
            [ 'AS65536', '2001:db8:bec0:f94f/64', ],
        ];
    }

    public function testRoute4WithHandle()
    {
        $route = new RIPE\Route( '192.0.2.0/24AS65536' );

        $this->assertSame( '192.0.2.0/24', $route->get( 'route' ) );
        $this->assertSame( 'AS65536', $route->get( 'origin' ) );
    }

    /**
     * @dataProvider route4ArgumentsProvider
     */
    public function testRoute4WithSeparateStrings( $a, $b )
    {
        $route = new RIPE\Route( $a, $b );

        $this->assertSame( '192.0.2.0/24', $route->get( 'route' ) );
        $this->assertSame( 'AS65536', $route->get( 'origin' ) );
    }

    public function testRoute4WithoutOrigin()
    {
        $route = new RIPE\Route( '192.0.2.0/24' );

        $this->assertSame( '192.0.2.0/24', $route->get( 'route' ) );
        $this->assertFalse( $route[ 'origin' ]->isDefined() );
    }

    public function testRoute4WithoutRoute()
    {
        $route = new RIPE\Route( 'AS65536' );

        $this->assertSame( 'AS65536', $route->get( 'origin' ) );
        $this->assertFalse( $route[ 'route' ]->isDefined() );
    }

    public function testRoute6WithHandle()
    {
        $route = new RIPE\Route( '2001:db8:bec0:f94f/64AS65536' );

        $this->assertSame( '2001:db8:bec0:f94f/64', $route->get( 'route' ) );
        $this->assertSame( 'AS65536', $route->get( 'origin' ) );
    }

    /**
     * @dataProvider route6ArgumentsProvider
     */
    public function testRoute6WithSeparateStrings( $a, $b )
    {
        $route = new RIPE\Route( $a, $b );

        $this->assertSame( '2001:db8:bec0:f94f/64', $route->get( 'route' ) );
        $this->assertSame( 'AS65536', $route->get( 'origin' ) );
    }

    public function testRoute6WithoutOrigin()
    {
        $route = new RIPE\Route( '2001:db8:bec0:f94f/64' );

        $this->assertSame( '2001:db8:bec0:f94f/64', $route->get( 'route' ) );
        $this->assertFalse( $route[ 'origin' ]->isDefined() );
    }

    public function testRoute6WithoutRoute()
    {
        $route = new RIPE\Route( 'AS65536' );

        $this->assertSame( 'AS65536', $route->get( 'origin' ) );
        $this->assertFalse( $route[ 'route' ]->isDefined() );
    }
}
