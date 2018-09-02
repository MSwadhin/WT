<?php 




function insertSells( $sell ){
	if(insertData($sell,"id","sells"))
		return true;
	return false;
}


function getCount( $dayno,$pid ){
	$sells = getDataArray("sells",false,false,"where dayno=".$dayno." and pid=".$pid);
	if( $sells && is_array($sells) )
		return count($sells);
	return 0;
}


function getAll( $pid ){
	$sells = getDataArray("sells",false,false,"where pid=".$pid);
	if( $sells && is_array($sells) ){
		$max = -1;
		foreach ($sells as $key => $value) {
			if( $value['dayno']>$max )
				$max = $value['dayno'];
		}
		$ans = array();
		$i=1;
		for($i=1;$i<=$max;$i++){
			$tmp = array(
				'd' => $i,
				'c' => getCount( $i,$pid )
			);
			$ans[] = $tmp;
			unset($tmp);
		}
		return $ans;
	}
	else{
		return false;
	}
}

?>