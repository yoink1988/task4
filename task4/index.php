<?php

include_once __DIR__ . "/lib/config.php";
include_once ROOT."/lib/autoload.php";


if(DB_DRIVER == DB_MYSQL)
{
	if(isset($_POST['selectAll']))
	{
		$db = new Mysql;
		$result = $db->select()->setColumns("`key`, data")->setTable(MYSQL_TABLE_NAME)->setWhere("`key` = 'user9'")->exec();
	}

	if(isset($_POST['addRow']) && !empty($_POST['string']))
	{
		$string = mysql_escape_string($_POST['string']);
		
		$params = array('key' => KEY, 'data' => "$string");
		$db = new Mysql;
		$result = $db->insert()->setTable(MYSQL_TABLE_NAME)->setParams($params)->exec();
	}
	if(isset($_POST['deleteRow']))
	{
		$db = new Mysql;
		$result = $db->delete()->setTable(MYSQL_TABLE_NAME)->setWhere("`key` = 'user9'")->setLimit(1)->exec();
	}

	if(isset($_POST['updateRow']) && !empty($_POST['string']))
	{
		$string = mysql_escape_string($_POST['string']);
		$params = array('key' => 'user9', 'data' => "$string" );
		$db = new Mysql;
		$result = $db->update()->setTable(MYSQL_TABLE_NAME)->setParams($params)->setWhere("`key` = 'user9'")->setLimit(1)->exec();
	}
}

if(DB_DRIVER == DB_POSTGRE)
	{

	if(isset($_POST['selectAll']))
	{
		$db = new Postgresql;
		$result = $db->select()->setColumns('key, data')->setTable(POSTGRE_TABLE_NAME)->setWhere("key = user9")->exec();
		var_dump($result);
	}

	if(isset($_POST['addRow']) && !empty($_POST['string']))
	{
		$string = pg_escape_string($_POST['string']);
		$params = array('key' => 'user9', 'data' => "$string");
		$db = new Postgresql;
		$result = $db->insert()->setTable(POSTGRE_TABLE_NAME)->setColumns('key, data ')->setParams($params)->exec();

	}
	if(isset($_POST['deleteRow']))
	{
		$db = new Postgresql;
		$result = $db->delete()->setTable(POSTGRE_TABLE_NAME)->setWhere("key = user9")->setLimit(1)->exec();
	}

	if(isset($_POST['updateRow']) && !empty($_POST['string']))
	{
		$string = pg_escape_string($_POST['string']);
		$params = array('key' => 'user9', 'data' => "$string" );
		$db = new Postgresql;
		$result = $db->update()->setTable(POSTGRE_TABLE_NAME)->setParams($params)->setWhere("key = user9")->setLimit(1)->exec();
	}
}
	include_once ROOT . "/templates/index.php";
?>