<？php
//http://www.cnblogs.com/xiangxiaodong/archive/2012/10/25/2739307.html


function unescape($str) {
    $str = rawurldecode($str);
    preg_match_all("/(?:%u.{4})|&#x.{4};|&#\d+;|.+/U",$str,$r);
    $ar = $r[0];
    //print_r($ar);

    foreach($ar as $k=>$v) {
        if(substr($v,0,2) == "%u"){
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("H4",substr($v,-4)));
  }
        elseif(substr($v,0,3) == "&#x"){
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("H4",substr($v,3,-1)));
  }
        elseif(substr($v,0,2) == "&#") {
             
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("n",substr($v,2,-1)));
        }
    }
    return join("",$ar);
}
?>
