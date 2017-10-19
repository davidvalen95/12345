<?php
namespace App\Helper\Classes;

use DOMDocument;


class CBible{

    public $book;
    public $chapter;
    public $completeChapter;
    public function __construct($version, $book, $chapter){
        $this->book = $book;
        $this->chapter = $chapter;
        $this->verses = [];
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, "http://alkitab.mobi/$version/$book/$chapter");
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        $httpText = curl_exec($curlSession);
        curl_close($curlSession);

        $htmlNode = new DOMDocument();
        // debug(htmlspecialchars($httpText));
        libxml_use_internal_errors(true);
        $htmlNode->loadHTML($httpText);
        libxml_use_internal_errors(false);

        $pattern = "/<p>((?!<\/p>).)*<\/p>/"; //# split all <p and capture
        $string = "$httpText";
        preg_match_all($pattern, $string, $matches);




        $int =0;
        $ayat = 1;
        // $currentChapterInformation = (object) array();
        $currentChapterInformation = [];
        foreach($htmlNode->getElementsByTagName('p') as $paragraph){
            $content = (object) [];
            foreach($paragraph->childNodes as $childNode){

                if($this->hasAtribute($childNode,"paragraphtitle")){
                    $content->type = "title";
                    $content->content = $childNode->textContent;
                    $content->nextVerse = $ayat;
                }

                if($this->hasAtribute($childNode, "reftext")){
                    $content->type = "verse";
                    $content->verse = $childNode->textContent;

                }
                if($this->hasAtribute($childNode,"data-begin")){
                    // $this->verses[(int)$content->verse] =  $childNode->textContent;
                    $content->content = $childNode->textContent;
                    $ayat ++;
                }
            }
            if(!empty((array)$content)){
                $currentChapterInformation [] = $content;
            }

        }

        $this->completeChapter =  ($currentChapterInformation);
        $this->setDefaultPreferences();
    }



    public function hasAtribute($node, $what){

        // echo $node->nodeType;
        if($node->nodeType == 1){
            foreach($node->attributes as $attribute){
                $name = $attribute->nodeName;
                $value = $attribute->nodeValue;
                if($what == $name || $what == $value){
                    return true;
                }
            }
        }

        return false;
    }

    public function setDefaultPreferences(){
        $this->book = ucwords($this->book);
    }
}








?>
