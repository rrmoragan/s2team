<?php

function tt($s=''){
	if( $s == '' ){ return tt('null'); }

	echo "<tt><br />#. $s</tt>";

	return true;
}
function pre($a=null){
	if($a==null){ return tt(); }

	echo '<pre>'.print_r($a,true).'</pre>';

	return true;
}


?>