<?php

namespace Core\HTML;

class Form{

	private $data;

	public $surround = 'p';

	public function __construct($data){
		$this->data = $data;
	}

	private function surround($html){
		return "<{$this->surround}>{$html}<{$this->surround}/>"; 
	}

	private function getValue($index){
		if(is_object($this->data)){
			return $this->data->$index;
		}

		return isset($this->data[$index]) ? $this->data[$index] : null;
	}


	public function input($name){
		return $this->surround('<input type="text" name="' . $name . '"value="' . $this->getValue($name). '">');
	}

	public function submit(){
		return 	$this->surround('<button type="submit">Envoyer</button>');
	}

	public function select($name, $options){
		$input = '<select class="form-control" name="' . $name . '">';
		foreach($options as $k => $v){
			$attributes = '';
			if ($k == $this->getValue($name)){
				$attributes = ' selected';
			}
			$input .= "<option value='$k'$attributes>$v</option>";
		}
		$input .= '</select>';

		return $this->surround($input);
	}
}
