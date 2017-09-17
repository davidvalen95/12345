<?
namespace App\Helper\Classes;

class CAlpetVerse{
    public $rawReference;
    public $book;
    public $pasalFrom;
    public $pasalTo;
    public $verseFrom;
    public $verseUntil;

    public $type;

    //# array
    public $contents;
    public function __construct($fullReference){
        $this->rawReference = $fullReference;

        //#luk23:5-12
        $fullReference = $this->sanitize($fullReference);

        //#(huruf)(digit)
        preg_match_all("/([^\d\W\s]+)(.*)/", $fullReference, $matches);

        //# Luk
        $this->book = $matches[1][0];
        //# 23:5-12 / 23-24
        $verse = $matches[2][0];
        // debug(strpos($verse, ":"));
        if(strpos($verse, ":") <= -1){
            // debug($verse);
            //# full book
            $this->type         = VERSE_TYPE_PASAL;
            $pasalDetail        = explode("-", $verse);
            $this->pasalFrom     = $pasalDetail[0];

            if(isset($pasalDetail[1])){
                $this->pasalTo      = $pasalDetail[1];
            }else{
                $this->pasalTo = $this->pasalFrom;
            }
        }
        else{
            //# 23:5-12
            $split = explode(":", $verse);
            //# 23
            $this->pasalFrom        = $split[0];
            $verseDetail        = explode("-", $split[1]);
            $this->verseFrom    = $verseDetail[0];
            if(isset($verseDetail[1])){
                $this->verseUntil   = $verseDetail[1];
            }
            $this->type = VERSE_TYPE_VERSES;
        }

        $bibles = [];
        if($this->type == VERSE_TYPE_PASAL){
            for($i = $this->pasalFrom;$i<= $this->pasalTo;$i++){
                // debug($alpetVerse);
                $bible =  new CBible($this->book, $i);
                $bibles[] = $bible;
            }
        }else if($this->type == VERSE_TYPE_VERSES){
            $bible =  new CBible($this->book, $this->pasalFrom);
            $bank = [];
            // debug((array)$bible->completeChapter);
            foreach($bible->completeChapter as $currentJson){
                // debug($currentJson);
                if($currentJson->type == "verse"){
                    if($currentJson->verse >= $this->verseFrom && $currentJson->verse <= $this->verseUntil){
                        $bank[] = $currentJson;

                    }
                }else if($currentJson->type == "title"){
                    if($currentJson->nextVerse >= $this->verseFrom  && $currentJson->nextVerse <= $this->verseUntil)
                    $bank[] = $currentJson;

                }
            }
            $bible->completeChapter = $bank;
            $bibles[] = $bible;
        }
        $this->contents = $bibles;
        // debug($this->contents);
    }

    public function getReadable(){
        $bookUpper = ucwords($this->book);
        if($this->type == VERSE_TYPE_VERSES){
            $until = "";
            if($this->verseFrom != $this->verseUntil){
                $until = "-$this->verseUntil";
            }
            return "$bookUpper {$this->pasalFrom}:$this->verseFrom{$until}";
        }
        if($this->type == VERSE_TYPE_PASAL){
            $until = "";
            if($this->pasalFrom != $this->pasalTo){
                $until = "-$this->pasalTo";
            }
            return "$bookUpper $this->pasalFrom{$until}";
        }
    }
    private function sanitize($str){
        $str = strtolower($str);
        $str = preg_replace("/\s+/", "", $str);


        return $str;
    }
}
?>
