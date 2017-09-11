<?php
namespace App\Helper\Classes;

use DOMDocument;


class CBible{

    public $book;
    public $chapter;
    public $verses;

    public $completeChapter;
    public function __construct($book, $chapter){
        $this->book = $book;
        $this->chapter = $chapter;
        $this->verses = [];
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, "http://alkitab.mobi/tb/$book/$chapter");
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $httpText = curl_exec($curlSession);

        $htmlNode = new DOMDocument();
        // debug(htmlspecialchars($paragraph));
        $htmlNode->loadHTML($httpText);

        $pattern = "/<p>((?!<\/p>).)*<\/p>/"; //# split all <p and capture
        $string = "$httpText";
        preg_match_all($pattern, $string, $matches);

        curl_close($curlSession);



        $int =0;

        $currentChapterInformation = (object) array();
        $currentChapterInformation->book = $book;
        $currentChapterInformation->chapter = $chapter;
        $currentChapterInformation->data=[];
        foreach($htmlNode->getElementsByTagName('p') as $paragraph){
            $content = (object) [];
            foreach($paragraph->childNodes as $childNode){

                if($this->hasAtribute($childNode,"paragraphtitle")){
                    $content->type = "title";
                    $content->content = $childNode->textContent;
                }

                if($this->hasAtribute($childNode, "reftext")){
                    $content->type = "verse";
                    $content->verse = $childNode->textContent;

                }
                if($this->hasAtribute($childNode,"data-begin")){
                    $this->verses[(int)$content->verse] =  $childNode->textContent;
                    $content->content = $childNode->textContent;
                }
            }
            if(!empty((array)$content)){
                $currentChapterInformation->data[] = $content;
            }

        }

        $this->completeChapter =  ($currentChapterInformation);

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

}








?>
