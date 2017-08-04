<?php
class Mysql extends Sql
{

	private function getConnect()
	{
		if($this->link != null)
		{
			return $this->link;
		}
		if($this->link = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS))
		{
			mysql_select_db(MYSQL_DB_NAME);
			return $this->link;
		}
	}


	public function clearString($string)
	{
		return mysql_escape_string($string);
	}


	public function exec()
	{
		parent::exec();
		switch ($this->queryType)
		{
			case 'insert':
				if(mysql_query($this->query, $this->getConnect()))
				{
					return true;
				}
				return false;

			case 'update':
				echo $this->query;
				if(mysql_query($this->query, $this->getConnect()))
				{
					return true;
				}
				return false;
			case 'select':
				$result=  array();
				if(!$stmt = mysql_query($this->query, $this->getConnect()))
				{
					return false;
				}

				while($res = mysql_fetch_array($stmt, MYSQL_ASSOC))
				{
					$result[]=$res;
				}
				return $result;

			case 'delete':
				if(mysql_query($this->query, $this->getConnect()))
				{
					return true;
				}
				return false;

		}

	}
			

	public function __construct(){}

}
