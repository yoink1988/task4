<?php
abstract class Db
{
	protected $table = '';
	protected $where = '';
	protected $columns = '';
	protected $join = '';
	protected $limit = null;
	protected $order = '';
	protected $params = array();
	protected $queryType = '';
	protected $query = '';
	protected $link = null;

//	abstract public function getConnect();
	public function select()
	{
		$this->queryType = 'select';
		return $this;
	}
	public function insert()
	{
		$this->queryType = 'insert';
		return $this;
	}
	public function delete()
	{
		$this->queryType = 'delete';
		return $this;
	}
	public function update()
	{
		$this->queryType = 'update';
		return $this;
	}

	public function setTable($table)
	{
		$this->table = $table;
		return $this;
	}
	public function setWhere($where)
	{
		$this->where = $where;
		return $this;
	}
	public function setColumns($columns)
	{
		if($columns == '*')
		{
			$this->columns = '';
		}
		$this->columns = $columns;
		return $this;
	}
	public function setJoin($join)
	{
		$this->join = $join;
		return $this;
	}
	public function setLimit($limit)
	{
		$this->limit = $limit;
		return $this;
	}
	public function setParams(array $params)
	{
		$this->params = $params;
		return $this;
	}

	public function exec()
	{
		$this->query ='';

		switch ($this->queryType)
		{
			case 'select':
				$this->query .= "SELECT ". $this->columns. " FROM ". "{$this->table}";
				if($this->join)
				{
					$this->query .= " {$this->join}";
				}
				if($this->where)
				{
					$this->query .= " where {$this->where}";
				}
				if($this->limit)
				{
					$this->query .= "{$this->limit}";
				}
				if($this->order)
					$this->query .= "{$this->order}";
				break;
			case 'insert':
				$this->query .="INSERT INTO ". "{$this->table} ";
				if(DB_DRIVER == DB_MYSQL)
				{
					$this->query .="SET ";

					foreach($this->params as $k => $v)
					{
						$this->query .= "`{$k}` = '{$v}', ";
					}
					$this->query = substr($this->query, 0, -2);
					break;
				}
				if(DB_DRIVER == DB_POSTGRE)
				{
					$this->query .="( {$this->columns} ) VALUES (";

					foreach($this->params as $param)
					{
					$this->query .= "{$param}, ";
					}
					$this->query = substr($this->query, 0, -2);
					$this->query .=")";
					break;
				}

			case 'delete':
				$this->query .= "DELETE FROM ". "{$this->table}";
				if($this->where)
				{
					$this->query .=" where {$this->where}";
				}
				else
				{
					$this->query = "";
					break;
				}
				if($this->limit)
				{
					$this->query .= " limit {$this->limit}";
				}
				break;
			case 'update':

				$this->query .= "UPDATE {$this->table} SET ";
				if(DB_DRIVER == DB_MYSQL)
				{
				foreach($this->params as $k => $v)
				{
					$this->query .= "`{$k}` = '{$v}', ";
				}
				$this->query = substr($this->query, 0, -2);
				}
				if(DB_DRIVER == DB_POSTGRE)
				{
					foreach($this->params as $k => $v)
					{
						$this->query .= "{$k} = {$v}, ";
					}
				$this->query = substr($this->query, 0, -2);
				}
				
				if($this->where)
				{
					$this->query .= " where {$this->where}";
				}
				else
				{
					$this->query = "";
					break;
				}
				if($this->limit)
				{
					$this->query .=" limit {$this->limit}";
				}
				break;
		}
	}


	public function __construct(){}
}
