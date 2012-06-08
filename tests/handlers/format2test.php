<?php

require '../../handlers/format2.php';

class format2test extends PHPUnit_Framework_TestCase
{

    /**
     * 
     * @var tvfilename\handlers\format1
     */
    static $Handler;

    public static function setupBeforeClass()
    {

        self::$Handler = new tvfilename\handlers\format2;
    }

    /**
     * @dataProvider providerMatches 
     */
    public function testMatches($fileName, $season, $episode)
    {
        
        $obj = self::$Handler;
        $this->assertTrue($obj->match($fileName));
        $this->assertEquals($season, $obj->season);
        $this->assertEquals($episode, $obj->episode);
        
    }

    /**
     * @dataProvider providerShouldntMatch
     */
    public function testShouldntMatch($fileName)
    {
        $this->assertFalse(self::$Handler->match($fileName));
    }

    /**
     * List of strings that should match.
     * @return type 
     */
    public function providerMatches()
    {
        return array(
            array('24 - 5x01 (HR.HDTV).avi', 5, 1),
            array('3rd Rock from the Sun - 1x01 - Brains and Eggs.avi', 1, 1),
            array('American Dad! - 1x01 - Pilot (pdtv).avi', 1, 1),
            array('The X Factor - 1x02 - Mooman (ll).avi',1,2),
        );
    }

    public function providerShouldntMatch()
    {
        return array(
            array('slkjdlfkjds 01E02'),
            array('fdsgdfgdfgdf 01E3'),
        );
    }

}

?>
