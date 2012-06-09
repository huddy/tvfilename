<?php

require '../../handlers/format12.php';

class format2test extends PHPUnit_Framework_TestCase
{

    /**
     * 
     * @var tvfilename\handlers\format5
     */
    static $Handler;

    public static function setupBeforeClass()
    {

        self::$Handler = new tvfilename\handlers\format12;
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
            array('(W_B) SDF Macross 31(x264)(6BD62B96).mkv',1,31),
        );
    }

    public function providerShouldntMatch()
    {
        return array(
            array('fdsgdfgdfgdf 01E3'),
            array('Test - 079 - sdfdsfds [x264]',0,79),
            array('astroboy.1980s.024.the.birth.of.astro.boy-dvdrip.xvid.avi', 1, 2),
            array('Bakemonogatari_Ep02_[1080p,BluRay,x264]_-_qIIq-THORA.mkv', 1, 2),
            array('08. Self-Conceit ~ The Art of Altercation.mkv',1,8),

        );
    }

}

?>
