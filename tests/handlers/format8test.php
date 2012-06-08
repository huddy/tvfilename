<?php

require '../../handlers/format8.php';

class format2test extends PHPUnit_Framework_TestCase
{

    /**
     * 
     * @var tvfilename\handlers\format5
     */
    static $Handler;

    public static function setupBeforeClass()
    {

        self::$Handler = new tvfilename\handlers\format8;
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
            array('[DBNL] One Piece - 079 - A Raid! The Tin Tyrant and Tin Plate Wapol! [x264][D1F15206].mkv', 1, 79),
            array('[DBNL] One Piece - 179 - A Raid! The Tin Tyrant and Tin Plate Wapol! [x264][D1F15206].mkv', 1, 179),
            array('One Piece - 001 - I m Luffy! The Man Whos Gonna Be King of the Pirates! [x264][857DCFD6].mkv', 1, 1),
            array('[moo-shi]_Desert_Punk_-_01[DVD][H264.AAC][17FC7F0C].mkv', 1, 1),
            array('[DBNL] One Piece - 179 - A Raid! The Tin Tyrant and Tin Plate Wapol! [x264][D1F15206].mkv',1,179),
        );
    }

    public function providerShouldntMatch()
    {
        return array(
            array('24.618.hr.hdtv.xvid-tvff.avi', 6, 18),
            array('fdsgdfgdfgdf 01E3'),
            array('astroboy.1980s.024.the.birth.of.astro.boy-dvdrip.xvid.avi', 1, 2),
            array('Bakemonogatari_Ep02_[1080p,BluRay,x264]_-_qIIq-THORA.mkv', 1, 2),
        );
    }

}

?>
