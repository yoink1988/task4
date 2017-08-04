<?php


class Postgresql extends Sql
{

	private function getConnect()
	{
		if($this->link !=null)
		{
			return $this->link;
		}
		if($this->link = pg_connect("host=".POSTGRE_HOST.
								  ", port=".POSTGRE_PORT.
								", dbname=".POSTGRE_DB_NAME.
								  ", user=".POSTGRE_USER.
							  ", password=".POSTGRE_PASS))
		{
			return $this->link;
		}
	}

public function clearString($string)
{
	return pg_escape_string($string);
}

	public function exec()
	{
		parent::exec();

		switch ($this->queryType)
		{
			case 'insert':
				if(pg_query($this->getConnect(), $this->query))
				{
					return true;
				}
				return false;

			case 'update':
				
				if(pg_query($this->getConnect(), $this->query))
				{
					return true;
				}
				return false;
			case 'select':
				
				$result=  array();
				if(!$stmt = pg_query($this->getConnect(), $this->query))
				{
					return false;
				}
				while($res = pg_fetch_array($stmt, PGSQL_ASSOC))
				{
					$result[]=$res;
				}
				return $result;

			case 'delete':

				if(pg_query($this->getConnect(), $this->query))
				{
					return true;
				}
					return false;

		}

	}

	public function __construct(){}
}
