<?php

require '../../handlers/format9.php';

class format2test extends PHPUnit_Framework_TestCase
{

    /**
     * 
     * @var tvfilename\handlers\format5
     */
    static $Handler;

    public static function setupBeforeClass()
    {

        self::$Handler = new tvfilename\handlers\format9;
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
            array('xpatriots.24.0815.720p.hdtv.x264-dimension.mkv',8,15),
            array('king.of.the.hill.1306.pdtv-lol.avi',13,6),
            array('TG1302.mkv',13,2),
            array('EFC 0104 - Avatar.avi',1,4),
            array('south.park.1202.dsr-0tv.avi',12,2),
        );
    }

    public function providerShouldntMatch()
    {
        return array(
            array('24.618.hr.hdtv.xvid-tvff.avi', 6, 18),
            array('fdsgdfgdfgdf 01E3'),
            array('Test - 079 - sdfdsfds [x264]',0,79),
            array('astroboy.1980s.024.the.birth.of.astro.boy-dvdrip.xvid.avi', 1, 2),
            array('Bakemonogatari_Ep02_[1080p,BluRay,x264]_-_qIIq-THORA.mkv', 1, 2),
        );
    }

}

?>
