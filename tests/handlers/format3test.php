<?php

require '../../handlers/format3.php';

class format2test extends PHPUnit_Framework_TestCase
{

    /**
     * 
     * @var tvfilename\handlers\format1
     */
    static $Handler;

    public static function setupBeforeClass()
    {

        self::$Handler = new tvfilename\handlers\format3;
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
            array('24 Season 1 Episode 01', 1, 1),
            array('Jiberish Season 01 Episode 07 x264 HS',1,7),
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
