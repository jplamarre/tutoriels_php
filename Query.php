<?php

use \Core\Database\QueryBuilder;

class Query{

	public static function __callStatic($method, $args){
		$query = new QueryBuilder();
		return call_user_func_array([$query, $method], $args);
	}
}

?>
