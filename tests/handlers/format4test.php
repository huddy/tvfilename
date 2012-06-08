<?php

require '../../handlers/format4.php';

class format2test extends PHPUnit_Framework_TestCase
{

    /**
     * 
     * @var tvfilename\handlers\format1
     */
    static $Handler;

    public static function setupBeforeClass()
    {

        self::$Handler = new tvfilename\handlers\format4;
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
            array('Bakemonogatari_Ep02_[1080p,BluRay,x264]_-_qIIq-THORA.mkv', 1, 2),
            array('Carlos.2010.E03.720p.BluRay.x264-CiNEFiLE.mkv', 1, 3),
            array('Clannad_Ep05_[1080p,BluRay,x264]_-_THORA.mkv', 1, 5),
            array('E05.720p.BluRay.x264-fty.mkv', 1, 5),
        );
    }

    public function providerShouldntMatch()
    {
        return array(
            array('slkjdlfkjds S1E02'),
            array('fdsgdfgdfgdf S01E3'),
        );
    }

}

?>
