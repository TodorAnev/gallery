<?php 

class Paginate {
	public $page;
	public $items_per_page;
	public $items_total_count;

	public function __construct($page=1,$items_per_page=4, $items_total_count=0){
		$this->page = (int)$page;
		$this->items_per_page = (int)$items_per_page;
		$this->items_total_count = (int)$items_total_count;
	}

	public function nextPage(){
		return $this->page + 1;
	}

	public function previousPage(){
		return $this->page - 1;
	}

	public function page_total(){
		return ceil($this->items_total_count/$this->items_per_page);
	}

	public function has_previous(){
		return $this->previousPage() >= 1 ? true : false; // if a previous is bigger or equal to 1 we have a previous page, else we don't
	}

	public function has_next(){
		return $this->nextPage() <= $this->page_total() ? true : false; // if the next page is a bigger number than our total pages we return false
	}

	public function offset(){
		return ($this->page - 1) * $this->items_per_page;
		//if items_per_page=10  > 0-10 > 11-21 , skips 10
	}
	// offset skips amout of pages you want to skip
}
 ?>}
