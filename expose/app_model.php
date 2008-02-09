<?php

class AppModel extends Model{
	
	//converts a list of ids in arrays to be used in SQL like IN (x,y,z)
	function convertListSQL($idList, $model, $field){
		
		$sqlIdList = "(";
		
		foreach ($idList as $temp){
			
			$sqlIdList = $sqlIdList . $temp[$model][$field] . ',';
		}
		
		$sqlIdList = rtrim($sqlIdList, ',') . ')';
		
		return $sqlIdList;
	}
	
	
}

?>