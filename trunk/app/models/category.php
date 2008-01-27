<?php
class Category extends AppModel
{
   	var $name = 'Category';

	//gets the sql for a super-category or a sub-category
	function getCategoriesSQL($category){
		
	        $result = $this->findByCategory($category);
        	$parentId = $result['Category']['parent_id'];
        	$id = $result['Category']['id'];
        	
			//super-categories have 0 parentid
			//hence, find the list of sub-categories under the super-category
        	if($parentId == 0){
        	
				//get of list of subcategories that have this super-category as parent
        		$listId = $this->findAll(array('Category.parent_id'=> $id),'id');
        		$categoryIdList = $this->convertListSQL($listId, 'Category', 'id');
        		return "Story.category_id IN $categoryIdList";

        	}
        	else{
	
				//sub-categories have a non-zero parentid as there are already the lowest level category
        		return "Story.category_id = $id";
        	}
		
	}
}
?>