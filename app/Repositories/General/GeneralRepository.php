<?php

namespace App\Repositories\General;

/**
 * Class GeneralRepository
 * @package App\Repositories\General
 */
class GeneralRepository
{

	public function __construct()
	{

	}
	
	/**
	 * @param $model
	 * @return mixed
	 */
	public function find($model, $id)
	{
		return $model->where('id', $id)->first();
	}
	

	public function findBy($table, $columns = [], $where = [], $paginate = null, $limit = null, $orderBy = null)
	{
		$query = DB::table("{$table} AS t")->leftJoin('statuses AS s', 's.id', '=', 't.status_id');
		if (!empty($columns)) {
			$cols = "";
			foreach ($columns as $column) {
				$cols .= "t.{$column},";
			}
			$query->select(rtrim(',', $cols), 's.name as status');
		} else {
			$query->select('t.*', 's.name as status');
		}
		
		if (!empty($where) && is_array($where)) {
			for ($i = 0; $i < count($where); $i++) {
				if (is_array(array_values($where)[$i])) {
					$query->wherein(array_keys($where)[$i], array_values($where)[$i]);
				} else {
					$query->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if ($orderBy != '') {
			if (is_array($orderBy)) {
				$query->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		} else {
			$query->orderBy('t.name', 'asc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$query->paginate($paginate);
		}
		return $query->get();
	}
	

	public function findAll($model, $where = [], $paginate = null, $limit = null, $orderBy = null)
	{
		$query = $model->where('id', '>', 0);
		if (!empty($where) && is_array($where)) {
			for ($i = 0; $i < count($where); $i++) {
				if (is_array(array_values($where)[$i])) {
					$query->wherein(array_keys($where)[$i], array_values($where)[$i]);
				} else {
					$query->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if ($orderBy != '') {
			if (is_array($orderBy)) {
				$query->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		} else {
			$query->orderBy('created_at', 'desc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$query->paginate($paginate);
		}
		
		return $query->get();
	}
	

	public function delete($model, $id)
	{
	    $row = $this->find($model, $id);
		return $row->delete();
	}
	

	public function getTableColumns($model)
	{
		return $model->getTableColumns();
	}

	public function create($model, $params)
	{
		$columns = $this->getTableColumns($model);
		$data = [];
		foreach ($columns as $column) {
			if ($column == 'id' || $column == 'created_at' || $column == 'updated_at' || $column == 'status_id') {
				continue;
			}
			$data[$column] = (isset($params[$column]) && $params[$column] != '') ? $params[$column] : null;
		}
		$created = $model::create($data);
		return $created;
	}
	

	public function update($model, $id, $data)
	{
        $row = $this->find($model, $id);
        $row->update($data);
		return $row;
	}

	public function count($model, $where = [])
	{
		$count = $model->where('id', '>', 0);
		if (!empty($where) && is_array($where)) {
			for ($i = 0; $i < count($where); $i++) {
				if (is_array(array_values($where)[$i])) {
					$count->wherein(array_keys($where)[$i], array_values($where)[$i]);
				} else {
					$count->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		return $count->count();
	}
}