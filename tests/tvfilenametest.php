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
    public function testMatches($fileName, $season, $episode, $handler)
    {

        $obj = self::$tvfilename->match($fileName);
        $this->assertInstanceOf('tvfilename\tvfilenameresult', $obj);
        $this->assertEquals($handler,$obj->handler);
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
            array('[DBNL] One Piece - 179 - A Raid! The Tin Tyrant and Tin Plate Wapol! [x264][D1F15206].mkv', 1, 179,'format8'),
            array('12 Oz. Mouse - S2E01 - Bowtime.avi', 2, 1, 'format1'),
            array('fdsgdfgdfgdf s01E3', 1, 3,'format1'),
            array('s1e01 - Hired.avi', 1, 1, 'format1'),
            array('24 - 5x01 (HR.HDTV).avi', 5, 1,'format2'),
            array('24 s01e01 - 0000-0100 PAL DVD.mkv', 1, 1, 'format1'),
            array('24 S07E23 720p BluRay DTS x264-CtrlHD.mkv', 7, 23,'format1'),
            array('24.618.hr.hdtv.xvid-tvff.avi', 6, 18,'format5'),
            array('30 Rock S01E01 720p WEB-DL DD5.1 AVC-CtrlHD.mkv', 1, 01,'format1'),
            array('30 Rock S04E01 Season Four 720p WEB-DL H.264 DD5.1.mkv', 4, 1,'format1'),
            array('3rd Rock from the Sun - 1x01 - Brains and Eggs.avi', 1, 1,'format2'),
            array('at.s03e01.tvrip-miragetv.avi', 3,1,'format1'),
            array('Im Alan Partridge - S01E01 - A Room With An Alan [dd].avi', 1, 1,'format1'),
            array('american.dad.316.pdtv-0tv.avi', 3, 16,'format5'),
            array('American Dad! - 1x01 - Pilot (pdtv).avi', 1, 1,'format2'),
            array('astroboy.1980s.02.the.birth.of.astro.boy-dvdrip.xvid.avi', 1, 2,'format6'),
            array('Bakemonogatari_Ep02_[1080p,BluRay,x264]_-_qIIq-THORA.mkv', 1, 2,'format4'),
            array('[DBNL] One Piece - 079 - A Raid! The Tin Tyrant and Tin Plate Wapol! [x264][D1F15206].mkv', 1, 79,'format8'),
            array('[DBNL] One Piece - 179 - A Raid! The Tin Tyrant and Tin Plate Wapol! [x264][D1F15206].mkv', 1, 179,'format8'),
            array('One Piece - 001 - I m Luffy! The Man Whos Gonna Be King of the Pirates! [x264][857DCFD6].mkv',1,1,'format8'),
            array('S02E03.mkv',2,3,'format1'),
            array('08 - A Pinky And The Brain Christmas.mpg',1,8,'format10'),
            array('Planetes.07.PSNR.mkv',1,7,'format6'),
            array('BUFFY THE VAMPIRE SLAYER - S01 E01 - WELCOME TO THE HELLMOUTH  NTSC DVD DD2.0 x264 MMI.mkv',1,1,'format1'),
            array('408 - Manners.avi',4,8,'format5'),
            array('Carlos.2010.E03.720p.BluRay.x264-CiNEFiLE.mkv',1,3,'format4'),
            array('Episode 718 Whats Up Doc.avi',7,18,'format5'),
            array('Clannad_Ep05_[1080p,BluRay,x264]_-_THORA.mkv',1,5,'format4'),
            array('Code_Geass_R2_Picture_Drama_S00E13_0.923_[1080p,BluRay,x264]_-_THORA.mkv',0,13,'format1'),
            array('Shin Chan - Episode 06.avi',1,6,'format7'),
            array('2e06-Belief.mkv',2,6,'format1'),
            array('[moo-shi]_Desert_Punk_-_01[DVD][H264.AAC][17FC7F0C].mkv',1,1,'format8'),
            array('Dragons Den S07E01 - 2009-07-15 - 720p-h264-ac3-subs.mkv',7,1,'format1'),
            array('DragonsDen-2007ChristmasSpecial-S05E10.avi',5,10,'format1'),
            array('Dragons\' Den - s6e1.avi',6,1,'format1'),
            array('EFC 0107 - Resurrection.avi',1,7,'format9'),
            array('Elfen Lied - 01 - A Chance Encounter.mkv',1,1,'format6'),
            array('E05.720p.BluRay.x264-fty.mkv',1,5,'format4'),
            array('Episode 7 - Bolognese sauce.jpg',1,7,'format7'),
            array('xpatriots.24.0815.720p.hdtv.x264-dimension.mkv',8,15,'format9'),
            array('king.of.the.hill.1306.pdtv-lol.avi',13,6,'format9'),
            array('TG1302.mkv',13,2,'format9'),
            array('EFC 0104 - Avatar.avi',1,4,'format9'),
            array('south.park.1202.dsr-0tv.avi',12,2,'format9'),
            array('Hellsing 04v2 [anime fin][6BD62B96].ogm',1,4,'format11'),
            array('Extras.2005.PAL.DVD.S02EE02.AC3.x264-sJR.mkv',2,2,'format14'),
            array('(W_B) SDF Macross 31(x264)(6BD62B96).mkv',1,31,'format12'),
            array('Star Trek Deep Space Nine s02extra03 - Sketchbook NTSC DVD x264 DD2.0-JCH.mkv',2,3,'format13'),
        );
    }

}

?>
