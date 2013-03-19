<?php
define("SIMPLE_NAMESPACE_WOOT", "http://www.woot.com/");

class SimplePie_Item_Woot extends SimplePie_Item 
{
	function get_thumbnail_src() 
	{
		$data = $this->get_item_tags(SIMPLE_NAMESPACE_WOOT, 'thumbnailimage');
		return $data[0]['data'];
	}

	function get_standard_src() 
	{
		$data = $this->get_item_tags(SIMPLE_NAMESPACE_WOOT, 'standardimage');
		return $data[0]['data'];
	}
	
	function get_substandard_src() 
	{
		$data = $this->get_item_tags(SIMPLE_NAMESPACE_WOOT, 'substandardimage');
		return $data[0]['data'];
	}

	function get_soldout_status() 
	{
		$data = $this->get_item_tags(SIMPLE_NAMESPACE_WOOT, 'soldout');
		return $data[0]['data'];
	}
	
	function get_soldout_percentage() 
	{
		$data = $this->get_item_tags(SIMPLE_NAMESPACE_WOOT, 'soldoutpercentage');
		return $data[0]['data'];
	}
	
	function get_price() 
	{
		$data = $this->get_item_tags(SIMPLE_NAMESPACE_WOOT, 'price');
		return $data[0]['data'];
	}
	
	function get_wootoff_status() 
	{
		$data = $this->get_item_tags(SIMPLE_NAMESPACE_WOOT, 'wootoff');
		return $data[0]['data'];
	}
	
}
?>
