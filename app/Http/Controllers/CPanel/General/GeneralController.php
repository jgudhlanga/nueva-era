<?php

namespace App\Http\Controllers\CPanel\General;

use App\Http\Traits\General\CommonTrait;
use App\Services\General\GeneralService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\General\GeneralRequest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Exception;

class GeneralController extends Controller
{

    use CommonTrait;

    protected $generalService;

    public function __construct(GeneralService $generalService)
    {
        $this->generalService = $generalService;
    }

    public function manager($model)
    {
        $modelNameSpace = $this->generalService->initializeModel($model);
        $data = $this->generalService->findAll($modelNameSpace);
        $args = [
            'statusActive' => $this->getStatusActive(), 'statusInActive' => $this->getStatusInActive(),
            'model' => $model,'data' => $data
        ];
        return view('cpanel.general.general-manager')->with($args);
    }

    public function store(GeneralRequest $request, $model)
    {
        try{
            DB::beginTransaction();
            $modelNameSpace = $this->generalService->initializeModel($model);
            $data = $request->all();
            $data['created_by'] = Auth::id();
            $data = $this->generalService->create($modelNameSpace, $data);
            if($data instanceof $modelNameSpace) {
                $created = $data;
                $status = Response::HTTP_CREATED;
                $message = trans('general.alerts.created', ['item' => $model]);
            }
            else{
                $created = null;
                $status = Response::HTTP_INTERNAL_SERVER_ERROR;
                $message = trans('general.alerts.error', ['item' => $model]);
            }
            DB::commit();
            return response()->json(['data' => $created, 'message' => $message], $status);
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }

    public function edit($model, $id)
    {
        $modelNameSpace = $this->generalService->initializeModel($model);
        $data = $this->generalService->find($modelNameSpace, $id);
        if($data instanceof $modelNameSpace){
            return response([
                'data' => $data
            ], Response::HTTP_OK);
        }
        else{
            notify()->flash(trans('general.alerts.not_found'), 'error');
        }
    }


    public function update(Request $request, $model, $id)
    {
        try{
            DB::beginTransaction();
            $data = $request->all();
            $data['updated_by'] = Auth::id();
            $modelNameSpace = $this->generalService->initializeModel($model);
            $item = $this->generalService->update($modelNameSpace, $id, $data);
            if($item instanceof $modelNameSpace) {
                $updated = $item;
                $status = Response::HTTP_CREATED;
                $message = trans('general.alerts.updated', ['item' => $model]);
            }
            else{
                $updated = null;
                $status = Response::HTTP_INTERNAL_SERVER_ERROR;
                $message = trans('general.alerts.error', ['item' => $model]);
            }
            DB::commit();
            return response()->json(['data' => $updated, 'message' => $message], $status);
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy($model, $id)
    {
        $modelNameSpace = $this->generalService->initializeModel($model);
        try{
            $this->generalService->delete($modelNameSpace, $id);
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function changeStatus($model, $id)
    {
        try
        {
            DB::beginTransaction();
            $modelNameSpace = $this->generalService->initializeModel($model);
            $item = $this->generalService->find($modelNameSpace, $id);
            $status = ($item->status_id == $this->getStatusActive()) ? $this->getStatusInActive() : $this->getStatusActive();
            $itemUpdate = $this->generalService->update($modelNameSpace, $id, ['status_id' => $status]);
            DB::commit();
            $message = ($itemUpdate->status_id == $this->getStatusActive()) ? 'general.alerts.reactivated' : 'general.alerts.deactivated';
            $title = ($itemUpdate->status_id == $this->getStatusActive()) ? 'alerts.reactivated' : 'alerts.deactivated';
            return response()->json(['data' => $itemUpdate, 'message' => trans($message, ['item' => $model]), 'title' => trans($title)], Response::HTTP_OK);
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }
}
