<?php
abstract class Sql

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

	abstract function clearString($string);


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
					$this->query .= " LIMIT {$this->limit} ";
				}
				if($this->order)
					$this->query .= "{$this->order}";
				break;
			case 'insert':
				$this->query .="insert into ". "{$this->table}";

                if($this->columns)
                {
                    $this->query .=" ({$this->columns})";
                }
                $values = implode(", ", $this->params);
				$this->query .=" values ($values)";
                break;

			case 'delete':
				$this->query .= "delete from ". "{$this->table}";
				if($this->where)
				{
					$this->query .=" where {$this->where}";
				}
				else
				{
					$this->query = "no where no update";
					break;
				}
				if($this->limit)
				{
					$this->query .= " LIMIT {$this->limit}";
                }

				break;
			case 'update':
				$this->query .= "update {$this->table} set ";

				foreach($this->params as $k => $v)
				{
					$this->query .= "{$k} = {$v}, ";
				}
				$this->query = substr($this->query, 0, -2);
				if($this->where)
				{
					$this->query .= " where {$this->where}";
				}

				else
				{
					$this->query = "no where no update";
					break;
				}
				if($this->limit)
				{
					$this->query .=" LIMIT {$this->limit}";
                }
				break;
		}
	}


	public function __construct(){}
}
