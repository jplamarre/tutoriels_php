<?php

namespace Core\Table; 

use Core\Database\Database;

class Table {

	protected $table;

	protected $db;

	public function __construct(Database $db){
		$parts = explode('\\', get_class($this));
		$class_name = end($parts);
		if ($this->table == null) {
			$this->table = strtolower(str_replace('Table', '', $class_name)) . 's';
		}
		$this->db = $db;
	}

	public function query($statement, $attributes = null, $only_one = false){
		if ($attributes) {
			return $this->db->prepare($statement, $attributes, str_replace('Table', 'Entity', get_class($this)), $only_one);
		} else {
			return $this->db->query($statement, str_replace('Table', 'Entity', get_class($this)), $only_one);
		}
				
	}


	public function find($id){
		return $this->query('SELECT * FROM ' . $this->table . ' WHERE id = ?', [$id],  true);
	}

	public function __get($key){
		$method = 'get' . ucfirst($key);
		$this->$key = $this->$method();
		return $this->$key;
	} 

	public function all(){
		return $this->query('SELECT * FROM ' . $this->table);
	}

	public function update($id, $fields){
		$sql_parts = [];
		$attributes = [];
		foreach($fields as $k => $v){
			$sql_parts[] = "$k = ?";
			$attributes[] = $v;
		}
		$attributes[] = $id;
		$sql_parts = implode(',',$sql_parts);	
		return $this->query("UPDATE {$this->table} SET $sql_parts  WHERE id = ?", $attributes,  true);
	}

	public function extract($key, $value){
		$records = $this->all();

		$return = [];

		foreach($records as $v){
			$return[$v->$key] = $v->$value;
		}

		return $return;
	}
	public function create($fields){
		$sql_parts = [];
		$attributes = [];
		foreach($fields as $k => $v){
			$sql_parts[] = "$k = ?";
			$attributes[] = $v;
		}
		$sql_parts = implode(',',$sql_parts);	
		return $this->query("INSERT INTO {$this->table} SET $sql_parts", $attributes, true);
	}

	public function delete($id){
		$this->query("DELETE FROM {$this->table} WHERE id=?", [$id], true);
	}

}
?>
