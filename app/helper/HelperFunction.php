<?php
    // use Auth;
    function debug($var="hello"){
        die(var_dump($var));
    }


    function getUrlFormat($string){
        $string = preg_replace('/[^\w\s]/',"",$string);
        $string = preg_replace('/\s+/',"-",$string);
        $string = strtolower($string);
        return $string;
    }

    function getNameFormat($string){
        $string = str_replace("-"," ",$string);
        $string = ucwords(strtolower($string));
        return $string;
    }

    function dateTimeToString($source, $format="D d-M"){

        $date = new DateTime($source);
        return $date->format($format); // 31.07.2012

    }
    function getDefaultDatetime($str){
        return date('Y-m-d H:i:s', strtotime($str));
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
