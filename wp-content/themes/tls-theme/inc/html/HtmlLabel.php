<?php
class HtmlLabel{

	/*
	 * $attr 	: Các thuộc tính của phần tử label
	 * 		   	  Id - style - width - class ...
	 * $options	: Các phần sẽ bổ xung khi phát sinh trường hợp mới
	 */

	public static function create($value = '', $attr = array(), $options = null){

		$html = '';

		//1. Tạo chuỗi thuộc tính từ tham số $attr
		$strAttr = '';
		if(count($attr)> 0){
			foreach ($attr as $key => $val){
				if($key != "type" && $key != 'value'){
					$strAttr .= ' ' . $key . '="' . $val . '" ';
				}
			}
		}

		//Tạo phần tử HTML
		$html = '<label '. $strAttr .'>'. $value .'</label>';

		return $html;
	}

}
