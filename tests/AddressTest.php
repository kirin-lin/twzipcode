<?php

use Mockery as m;
use Recca0120\Twzipcode\Address;

class AddressTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function test_get_tokens()
    {
        /*
        |------------------------------------------------------------
        | Arrange
        |------------------------------------------------------------
        */

        $address = '臺北市大安區市府路1號';

        /*
        |------------------------------------------------------------
        | Act
        |------------------------------------------------------------
        */

        $address = new Address($address);

        /*
        |------------------------------------------------------------
        | Assert
        |------------------------------------------------------------
        */

        $this->assertSame([
            ['', '', '臺北', '市'],
            ['', '', '大安', '區'],
            ['', '', '市府', '路'],
            ['1', '', '', '號'],
        ], $address->getTokens());
    }

    public function test_get_tokens_with_zipcode()
    {
        /*
        |------------------------------------------------------------
        | Arrange
        |------------------------------------------------------------
        */

        $address = '11008臺北市大安區市府路1號';

        /*
        |------------------------------------------------------------
        | Act
        |------------------------------------------------------------
        */

        $address = new Address($address);

        /*
        |------------------------------------------------------------
        | Assert
        |------------------------------------------------------------
        */

        $this->assertSame([
            ['', '', '臺北', '市'],
            ['', '', '大安', '區'],
            ['', '', '市府', '路'],
            ['1', '', '', '號'],
        ], $address->getTokens());
    }

    public function test_get_tokens_with_subno()
    {
        /*
        |------------------------------------------------------------
        | Arrange
        |------------------------------------------------------------
        */

        $address = '臺北市大安區市府路1之1號';

        /*
        |------------------------------------------------------------
        | Act
        |------------------------------------------------------------
        */

        $address = new Address($address);

        /*
        |------------------------------------------------------------
        | Assert
        |------------------------------------------------------------
        */

        $this->assertSame([
            ['', '', '臺北', '市'],
            ['', '', '大安', '區'],
            ['', '', '市府', '路'],
            ['1', '之1', '', '號'],
        ], $address->getTokens());
    }

    public function test_get_tokens_with_tricky()
    {
        /*
        |------------------------------------------------------------
        | Arrange
        |------------------------------------------------------------
        */

        $address = '桃園縣中壢市普義10號';

        /*
        |------------------------------------------------------------
        | Act
        |------------------------------------------------------------
        */

        $address = new Address($address);

        /*
        |------------------------------------------------------------
        | Assert
        |------------------------------------------------------------
        */

        $this->assertSame([
            ['', '', '桃園', '縣'],
            ['', '', '中壢', '市'],
            ['', '', '普義', ''],
            ['10', '', '', '號'],
        ], $address->getTokens());
    }
}
