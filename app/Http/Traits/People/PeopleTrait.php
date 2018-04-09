<?php

namespace App\Http\Traits\People;
use App\Services\General\GeneralService;
use App\Models\General\Status;

/**
 * Trait PeopleTrait
 * @package App\Http\Traits\People
 */
trait PeopleTrait
{

    /**
     * @param $model
     * @return mixed
     */
    public function getOptions($model)
    {
        $modelNameSpace = GeneralService::initializeModelStatic($model);
        return GeneralService::findAllStatic($modelNameSpace, ['status_id' => Status::ACTIVE], null, null, ['name'=> 'asc']);
    }

    /**
     * @return mixed
     */
    public function titleOptions()
    {
        return $this->getOptions('Title');
    }

    /**
     * @return mixed
     */
    public function genderOptions()
    {
        return $this->getOptions('Gender');
    }

    /**
     * @return mixed
     */
    public function languageOptions()
    {
        return $this->getOptions('Language');
    }

    /**
     * @return mixed
     */
    public function maritalStatusOptions()
    {
        return $this->getOptions('MaritalStatus');
    }

    /**
     * @return mixed
     */
    public function occupationOptions()
    {
        return $this->getOptions('Occupation');
    }

    /**
     * @return mixed
     */
    public function raceOptions()
    {
        return $this->getOptions('Race');
    }

    /**
     * @return mixed
     */
    public function memberTypeOptions()
    {
        return $this->getOptions('MemberType');
    }

    /**
     * @return mixed
     */
    public function addressTypeOptions()
    {
        return $this->getOptions('AddressType');
    }

    /**
     * @return mixed
     */
    public function applicationTypeOptions()
    {
        return $this->getOptions('ApplicationType');
    }

    /**
     * @return mixed
     */
    public function interestOptions()
    {
        return $this->getOptions('Interest');
    }
}