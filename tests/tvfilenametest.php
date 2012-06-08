<?php

require '../tvfilename.php';

class tvfilenametest extends PHPUnit_Framework_TestCase
{

    /**
     * 
     * @var tvfilename\handlers\format1
     */
    static $tvfilename;

    public static function setupBeforeClass()
    {

        self::$tvfilename = new tvfilename\tvfilename;
    }

    /**
     * @dataProvider providerMatches 
     */
    public function testMatches($fileName, $season, $episode)
    {

        $obj = self::$tvfilename->match($fileName);
        $this->assertInstanceOf('tvfilename\tvfilenameresult', $obj);
        $this->assertTrue($obj->status);
        $this->assertEquals($season,$obj->season);
        $this->assertEquals($episode,$obj->episode);
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
            array('24 - 5x01 (HR.HDTV).avi', 5, 1),
            array('24 s01e01 - 0000-0100 PAL DVD.mkv', 1, 1),
            array('24 S07E23 720p BluRay DTS x264-CtrlHD.mkv', 7, 23),
            array('24.618.hr.hdtv.xvid-tvff.avi', 6, 18),
            array('30 Rock S01E01 720p WEB-DL DD5.1 AVC-CtrlHD.mkv', 1, 01),
            array('30 Rock S04E01 Season Four 720p WEB-DL H.264 DD5.1.mkv', 4, 1),
            array('3rd Rock from the Sun - 1x01 - Brains and Eggs.avi', 1, 1),
            array('at.s03e01.tvrip-miragetv.avi', 3,1),
            array('Im Alan Partridge - S01E01 - A Room With An Alan [dd].avi', 1, 1),
            array('american.dad.316.pdtv-0tv.avi', 3, 16),
            array('American Dad! - 1x01 - Pilot (pdtv).avi', 1, 1),
            array('astroboy.1980s.02.the.birth.of.astro.boy-dvdrip.xvid.avi', 1, 2),
            array('Bakemonogatari_Ep02_[1080p,BluRay,x264]_-_qIIq-THORA.mkv', 1, 2),
            array('[DBNL] One Piece - 079 - A Raid! The Tin Tyrant and Tin Plate Wapol! [x264][D1F15206].mkv', 1, 79),
            array('[DBNL] One Piece - 179 - A Raid! The Tin Tyrant and Tin Plate Wapol! [x264][D1F15206].mkv', 1, 179),
            array('One Piece - 001 - I m Luffy! The Man Whos Gonna Be King of the Pirates! [x264][857DCFD6].mkv',1,1),
            array('S02E03.mkv',2,3),
            array('08 - A Pinky And The Brain Christmas.mpg',1,8),
            array('Planetes.07.PSNR.mkv',1,7),
            array('BUFFY THE VAMPIRE SLAYER - S01 E01 - WELCOME TO THE HELLMOUTH  NTSC DVD DD2.0 x264 MMI.mkv',1,1),
            array('408 - Manners.avi',4,8),
            array('Carlos.2010.E03.720p.BluRay.x264-CiNEFiLE.mkv',1,3),
            array('Episode 718 Whats Up Doc.avi',7,18),
            array('Clannad_Ep05_[1080p,BluRay,x264]_-_THORA.mkv',1,5),
            array('Code_Geass_R2_Picture_Drama_S00E13_0.923_[1080p,BluRay,x264]_-_THORA.mkv',0,13),
            array('Shin Chan - Episode 06.avi',1,6),
            array('2e06-Belief.mkv',2,6),
            array('[moo-shi]_Desert_Punk_-_01[DVD][H264.AAC][17FC7F0C].mkv',1,1),
            array('Dragons Den S07E01 - 2009-07-15 - 720p-h264-ac3-subs.mkv',7,1),
            array('DragonsDen-2007ChristmasSpecial-S05E10.avi',5,10),
            array('Dragons\' Den - s6e1.avi',6,1),
            array('EFC 0107 - Resurrection.avi',1,7),
            array('Elfen Lied - 01 - A Chance Encounter.mkv',1,1),
            array('E05.720p.BluRay.x264-fty.mkv',1,5),
            array('Episode 7 - Bolognese sauce.jpg',1,7)
        );
    }

}

?>
