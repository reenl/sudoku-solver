<?php $s=explode(',',trim(fgets(STDIN)));$b=null;define('C',count($s));define('S',sqrt(C));define('Q',sqrt(S));function p($x,$y){return$x+$y*S;}function x($p){return$p%S;}function y($p){return(int)($p/S);}function v($p){global$s;$v=$s[$p];if(is_array($v)||$v==='.')return null;return$v;}function c($p){return range(x($p),C-1,S);}function r($p){$s=y($p)*S;return range($s,$s+S-1);}function m($p){return array_merge(c($p),r($p),b($p));}function a($i){static$a;$a=$a?:range(1,S);return array_diff($a,$i);}function f(&$n,&$b,$t){foreach($n as$p=>$i){if(!is_array($i))continue;$o=[a($i)];$l=$t($p);foreach($l as$h){if($h==$p)continue;if(!is_array($n[$h]))continue;$o[]=a($n[$h]);}if(count($o)<2){$n=$b;$b=null;return true;}$m=call_user_func_array('array_diff',$o);if(count($m)==1){l($p,reset($m));return true;}}return false;}function l($p,$v){global$s;$s[$p]=$v;foreach(m($p) as$pos2){is_array($s[$pos2])&&$s[$pos2][]=$v;}}function u($p){$i=[];foreach(m($p)as$h)$i[]=v($h);return$i;}function b($p){static$b=[];$y=y($p);$x=x($p);$c=(int)($x/Q);$d=(int)($y/Q);$p=$c+$d*Q;if(isset($b[$p]))return$b[$p];$l=[];$e=$c*Q;$f=$e+Q;$g=$d*Q;$h=$g+Q;for($x=$e;$x<$f;$x++){for($y=$g;$y<$h;$y++){$l[]=p($x,$y);}}return$b[$p]=$l;}$n=function()use(&$s,&$b){$m=false;$v=true;foreach($s as$p=>$i){if($i=='.'){$s[$p]=$i=u($p);}if(is_array($i)){$o=a($i);if(count($o)==1){l($p,reset($o));$m=true;continue;}$v=false;}}if($v)return true;if($m)return false;foreach(['c','r','b']as$t){if(f($s,$b,$t))return false;}$b=$b?:$s;for($z=2;$z<=S;$z++){foreach($s as$p=>$i){if(!is_array($i)){continue;}$o=a($i);if(count($o)==$z){l($p,$o[array_rand($o)]);return false;}}}};while(!$n());echo implode(',',$s)."\n";