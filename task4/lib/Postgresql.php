<?php


class Postgresql extends Db
{

	private function getConnect()
	{
		if($this->link !=null)
		{
			return $this->link;
		}
		if($this->link = pg_connect("host=".POSTGRE_HOST.
								", dbname=".POSTGRE_DB_NAME.
								  ", user=".POSTGRE_USER.
							  ", password=".POSTGRE_PASS))//PORT
		{
			return $this->link;
		}
	}



	public function exec()
	{
		parent::exec();

		switch ($this->queryType)
		{
			case 'insert':
				if(!pg_query($this->getConnect(), $this->query))
				{
					return false;
				}
				return SUCCESS;

			case 'update':
				
				if(!pg_query($this->getConnect(), $this->query))
				{
					return false;
				}
				return SUCCESS;
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
					return pg_affected_rows($this->getConnect()). " row deleted";
				}
				else
				{
					return false;
				}
		}

	}










	public function __construct(){}
}
