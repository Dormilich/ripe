<?php

use Dormilich\Http\RangeInterface;
use Dormilich\RIPE\Inetnum;
use PHPUnit\Framework\TestCase;

class InetnumTest extends TestCase
{
    public function testIpRangeFromString()
    {
        $obj = new Inetnum( '198.51.100.35 - 198.51.100.193' );

        $this->assertSame( '198.51.100.35 - 198.51.100.193', $obj->get( 'inetnum' ) );
    }

    public function testIpRangeFromCidr()
    {
        $obj = new Inetnum( '198.51.100.35/27' );

        $this->assertSame( '198.51.100.32 - 198.51.100.63', $obj->get( 'inetnum' ) );
    }

    public function testIpRangeFromObject()
    {
        $range = $this->createMock( RangeInterface::class );
        $range->method( 'getFirstIP' )->willReturn( '198.51.100.35' );
        $range->method( 'getLastIP' )->willReturn( '198.51.100.193' );

        $obj = new Inetnum( $range );

        $this->assertSame( '198.51.100.35 - 198.51.100.193', $obj->get( 'inetnum' ) );
    }

    public function testIPRangeFromArguments()
    {
        $obj = new Inetnum( '198.51.100.193', '198.51.100.35' );

        $this->assertSame( '198.51.100.35 - 198.51.100.193', $obj->get( 'inetnum' ) );
    }
}
