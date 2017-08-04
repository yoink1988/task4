<?php

include_once __DIR__ . "/lib/config.php";
include_once ROOT_DIR."/lib/functions.php";
$output = array('%output%' => '');
	dump($_POST);
if(DB_DRIVER == DB_MYSQL)
{
	if(isset($_POST['select']))
	{
	
		$db = new Mysql;
		$result = $db->select()->setColumns("`key`, data")->setTable(MYSQL_TABLE_NAME)->setWhere("`key` = 'user9'")->setLimit(1)->exec();
		if($result)
		{
			$row = array_shift($result);
			$output['%output%'] .= '<span>'.$row['key']." ".$row['data'].'</span>';
		}
		else
		{
			$output['%output%'] = '<span>No data</span>';
		}
	}

	if(isset($_POST['addRow']) && !empty($_POST['string']))
	{
		$db = new Mysql;
		$string = $db->clearString($_POST['string']);
		$params = array("key" => "'user9'", "data" => "'$string'");
		if($db->insert()->setTable(MYSQL_TABLE_NAME)->setColumns("`key`, `data`")
														->setParams($params)
														->setLimit(1)
														->exec())
		{
			$output['%output%'] = '<span>Row added</span>';
		}
	}

	if(isset($_POST['deleteRow']))
	{
		$db = new Mysql;
		if($db->delete()->setTable(MYSQL_TABLE_NAME)->setWhere("`key` = 'user9'")->setLimit(1)->exec())
		{
			$output['%output%'] = '<span>Row Deleted</span>';
		}
	}

	if(isset($_POST['updateRow']) && !empty($_POST['string']))
	{
		$db = new Mysql;
		$string = $db->clearString($_POST['string']);
		$params = array("`key`" => "'user9'", "`data`" => "'$string'");
		
		if($db->update()->setTable(MYSQL_TABLE_NAME)->setParams($params)
													->setWhere("`key` = 'user9'")
													->setLimit(1)
													->exec())
		{
			$output['%output%'] = '<span>Row Changed</span>';
		}
	}
}

if(DB_DRIVER == DB_POSTGRE)
{
	if(isset($_POST['select']))
	{
		$db = new Postgresql;
		$result = $db->select()->setColumns("`key`, data")->setTable(POSTGRE_TABLE_NAME)->setWhere("key = 'user9'")->setLimit(1)->exec();
		if($result)
		{
			$row = array_shift($result);
			$output['%output%'] .= '<span>'.$row['key']." ".$row['data'].'</span>';
		}
		else
		{
			$output['%output%'] = '<span>No data</span>';
		}
	}

	if(isset($_POST['addRow']) && !empty($_POST['string']))
	{
		$db = new Postgresql;
		$string = $db->clearString($_POST['string']);
		$params = array("key" => "'user9'", "data" => $string);
		if($db->insert()->setTable(POSTGRE_TABLE_NAME)->setColumns("`key`, `data`")
														->setParams($params)
														->setLimit(1)
														->exec())
		{
			$output['%output%'] = '<span>Row added</span>';
		}
	}

	if(isset($_POST['deleteRow']))
	{
		$db = new Postgresql;
		if($db->delete()->setTable(POSTGRE_TABLE_NAME)->setWhere("key = 'user9'")->setLimit(1)->exec())
		{
			$output['%output%'] = '<span>Row Deleted</span>';
		}
	}

	if(isset($_POST['updateRow']) && !empty($_POST['string']))
	{
		$db = new Postgresql;
		$string = $db->clearString($_POST['string']);
		$params = array("key" => "'user9'", "data" => $string);

		if($db->update()->setTable(POSTGRE_TABLE_NAME)->setParams($params)
													->setWhere("key = 'user9'")
													->setLimit(1)
													->exec())
		{
			$output['%output%'] = '<span>Row Changed</span>';
		}
	}
}

templateRender($output);
?>