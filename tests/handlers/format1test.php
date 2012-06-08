<?php

require '../../handlers/format1.php';

class format1test extends PHPUnit_Framework_TestCase
{

    /**
     * 
     * @var tvfilename\handlers\format1
     */
    static $Handler;

    public static function setupBeforeClass()
    {

        self::$Handler = new tvfilename\handlers\format1;
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
            array('12 Oz. Mouse - S2E01 - Bowtime.avi', 2, 1),
            array('fdsgdfgdfgdf s01E3', 1, 3),
            array('s1e01 - Hired.avi', 1, 1),
            array('24 s01e01 - 0000-0100 PAL DVD.mkv', 1, 1),
            array('24 S07E23 720p BluRay DTS x264-CtrlHD.mkv', 7, 23),
            array('30 Rock S01E01 720p WEB-DL DD5.1 AVC-CtrlHD.mkv', 1, 01),
            array('30 Rock S04E01 Season Four 720p WEB-DL H.264 DD5.1.mkv', 4, 1),
            array('at.s03e01.tvrip-miragetv.avi', 3, 1),
            array('Im Alan Partridge - S01E01 - A Room With An Alan [dd].avi', 1, 1),
            array('S02E03.mkv', 2, 3),
            array('BUFFY THE VAMPIRE SLAYER - S01 E01 - WELCOME TO THE HELLMOUTH  NTSC DVD DD2.0 x264 MMI.mkv', 1, 1),
            array('Code_Geass_R2_Picture_Drama_S00E13_0.923_[1080p,BluRay,x264]_-_THORA.mkv', 0, 13),
            array('Dragons Den S07E01 - 2009-07-15 - 720p-h264-ac3-subs.mkv', 7, 1),
            array('DragonsDen-2007ChristmasSpecial-S05E10.avi', 5, 10),
            array('Dragons\' Den - s6e1.avi', 6, 1),
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
