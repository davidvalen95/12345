<?php
namespace App\Helper\Classes;

use DOMDocument;

class CBible{

    public $book;
    public $chapter;
    public $verses;
    public function __construct($book, $chapter){
        $this->book = $book;
        $this->chapter = $chapter;
        $this->verses = [];
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, "http://alkitab.mobi/tb/$book/$chapter");
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $httpText = curl_exec($curlSession);


        $pattern = "/<p>((?!<\/p>).)*<\/p>/"; //# split all <p and capture
        $string = "$httpText";
        preg_match_all($pattern, $string, $matches);

        curl_close($curlSession);


        $int =0;
        foreach($matches[0] as $paragraph){
            $pNode = new DOMDocument();
            // debug(htmlspecialchars($paragraph));
            $pNode->loadHTML($httpText);
            debug($pNode->getElementsByTagName('p')[10]);
            // $pNode =
            if(strpos($paragraph,'reftext')){
                $pattern = "/<a((?!>).)*>(((?!<\/a).)*)<\/a>/"; //# split all <p and capture
                preg_match_all($pattern, $paragraph, $verseMatches);
                $this->verses[(int)$verseMatches[1]] = "sdf";
                //<a((?!>).)*>((?!<\\\/a).)*<\\\/a>

                $int++;
            }
        }



        return response()->json($matches[0]);
    }

}








?>
