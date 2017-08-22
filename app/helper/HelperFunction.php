<?php
    // use Auth;
    function debug($var="hello"){
        die(var_dump($var));
    }




    function getHighlight($needle,$haystack,$format=false){
        $needle = ucwords($needle);
        $haystack = ucwords($haystack);
        if($format){
            $needle = getSearchFormat($needle);
        }
        // debug($needle.$haystack);
        return str_replace($needle,"<span style='background-color:yellow;'><b>$needle</b></span>",$haystack);
    }



    function getUrlFormat($string){
        $string = preg_replace('/[^\w\s]/',"",$string);
        $string = preg_replace('/\s+/',"-",$string);
        $string = strtolower($string);
        return $string;
    }

    function getNameFormat($string){
        $string = str_replace("-"," ",$string);
        $string = preg_replace("/\s+/"," ",$string);
        $string = ucwords(strtolower($string));
        return $string;
    }

    function dateTimeToString($source, $format="D d-M"){
        date_default_timezone_set('Asia/Jakarta');
        $date = new DateTime($source);
        return $date->format($format); // 31.07.2012

    }
    function getDefaultDatetime($str){
        date_default_timezone_set('Asia/Jakarta');
        return date('Y-m-d H:i:s', strtotime($str));
    }

    function getSearchFormat($str){
        $str = strip_tags($str,'<br>'); //# kcuali br
        $str = str_replace('<br>',' ',$str); //# br jadi space
        // $str = preg_replace('/[^a-zA-Z\s]/','',$str); //# trims non word but not space
        // $str = preg_replace('/[\s+]/',' ',$str); //# trims spaces and non word
        $str = preg_replace('/[^a-zA-Z]/','',$str); //# trims everything
        $str = strtolower($str);
        // debug($str);
        return $str;
    }



    function pagination($pagination){
		/*
		 * totalData	: data dari table
		 * fetch		: data per page
		 * threshold	: deretan pagination
		 * last			: pagination terakhir
		 *
		 * start	: terawal dari current
		 * end		: terjuh dari pagination
		 *
		 *
		 */



		$totalData	 		= $pagination->total();
		$fetch	 			= $pagination->perPage();
		$threshold			= 5;
		$last				= ceil($totalData / $fetch);
        $current            = $pagination->currentPage();

		$start				= ($current-$threshold >= $threshold?$current-$threshold:1);
		$end				= ($current+$threshold >= $last?$last:$current+$threshold);
		//debug(ceil($pagination / $fetch));
		$list 				= "
					<ul class='pagination pagination-sm no-margin pull-right'>
						<li>
                            <a href='".$pagination->url(1)."'>First</a>
                        </li>
		";
		for($i=$start;$i<=$end;$i++){
			$href    		= ($i==$current?"":"href='".$pagination->url($i)."'");
			$active  		= ($i==$current?"active":"");


			$list	.= "<li>
                            <a $href class='$active'>$i</a>
                        </li>";
		}

		$list				.= "<li>
                                    <a href='".$pagination->url($pagination->lastPage())."'>Last</a>
                                </li>
                                </ul>";
		return $list;
	}


    function saveEvent($message){
        $event = new App\Model\Event();

        $event->detail = $message;
        $user = Auth::user();
        
        $event->getUser()->associate($user);
        $event->save();
    }
 ?>
