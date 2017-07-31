<?php
class Mysql extends Db
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



	public function exec()
	{
		parent::exec();
		switch ($this->queryType)
		{
			case 'insert':
				if(!mysql_query($this->query, $this->getConnect()))
				{
					return false;
				}
				return SUCCESS;

			case 'update':
				if(!mysql_query($this->query, $this->getConnect()))
				{
					return false;
				}
				return SUCCESS;
			case 'select':
				$result=  array();
				if(!$stmt = mysql_query($this->query, $this->getConnect()))
				{
					echo mysql_error($this->getConnect());
					return "no data";
				}
//				$i=1;
				while($res = mysql_fetch_array($stmt, MYSQL_ASSOC))
				{
//					$res['id'] = $i;
					$result[]=$res;

//					$i++;
				}
				return $result;

			case 'delete':
				if(mysql_query($this->query, $this->getConnect()))
				{
					return mysql_affected_rows($this->getConnect())." row deleted";
				}
				else
				{
					return false;
				}
		}

	}
			
			

	










	public function __construct(){}

}
