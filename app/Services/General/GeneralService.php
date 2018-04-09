<?php

namespace App\Services\General;


use App\Repositories\General\GeneralRepository;
use Illuminate\Support\Facades\Log;

class GeneralService
{
    protected $generalRepository;

    /**
     * GeneralService constructor.
     * @param GeneralRepository $generalRepository
     */
    public function __construct(GeneralRepository $generalRepository)
    {
        $this->generalRepository = $generalRepository;
    }

    public function find($model, $id )
    {
        return $this->generalRepository->find($model, $id);
    }

    public function findBy($table, $columns=[], $where=[], $paginate=null, $limit=null, $orderBy=null)
    {
        return $this->generalRepository->findBy($table, $columns, $where, $paginate, $limit, $orderBy);
    }

    public function findAll($model, $where=[], $paginate=null, $limit=null, $orderBy=null )
    {
        return $this->generalRepository->findAll($model, $where, $paginate, $limit, $orderBy);
    }

    public function create($model, $params)
    {
        return $this->generalRepository->create($model, $params);
    }

    public function update($model, $id, $data)
    {
        return $this->generalRepository->update($model, $id, $data);
    }


    public function delete($model, $id)
    {
        return $this->generalRepository->delete($model, $id);
    }

    public function count($model, $where = [])
    {
        return $this->generalRepository->count($model, $where);
    }

    public function initializeModel($model)
    {
        $model = config('system.general_model_namespace').$model;
        return new $model();
    }

    public static function initializeModelStatic($model)
    {
        $model = config('system.general_model_namespace').$model;
        return new $model();
    }

    public static function findAllStatic($model, $where=[], $paginate=null, $limit=null, $orderBy=null )
    {
        $generalRepo = new GeneralRepository();
        return $generalRepo->findAll($model, $where, $paginate, $limit, $orderBy);
    }

}