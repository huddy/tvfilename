<?php

require '../../handlers/format7.php';

class format2test extends PHPUnit_Framework_TestCase
{

    /**
     * 
     * @var tvfilename\handlers\format5
     */
    static $Handler;

    public static function setupBeforeClass()
    {

        self::$Handler = new tvfilename\handlers\format7;
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
            array('Episode 18', 1, 18),
            array('23astroboy.1980s Episode 45.of.astro.boy-dvdrip.xvid.avi', 1, 45),
            array('Shin Chan - Episode 06.avi', 1, 6),
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
