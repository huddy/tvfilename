<?php

require '../../handlers/format5.php';

class format2test extends PHPUnit_Framework_TestCase
{

    /**
     * 
     * @var tvfilename\handlers\format5
     */
    static $Handler;

    public static function setupBeforeClass()
    {

        self::$Handler = new tvfilename\handlers\format5;
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
            array('stargate.atlantis.409.dsr.xvid.notv.avi', 4, 9),
            array('24.618.hr.hdtv.xvid-tvff.avi', 6, 18),
            array('american.dad.316.pdtv-0tv.avi', 3, 16),
            array('408 - Manners.avi', 4, 8),
        );
    }

    public function providerShouldntMatch()
    {
        return array(
            array('slkjdlfkjds 01E02 x264'),
            array('fdsgdfgdfgdf 01E3'),
            array('astroboy.1980s.02.the.birth.of.astro.boy-dvdrip.xvid.avi', 1, 2),
            array('Bakemonogatari_Ep02_[1080p,BluRay,x264]_-_qIIq-THORA.mkv', 1, 2),
        );
    }

}

?>
