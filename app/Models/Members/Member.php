<?php

namespace App\Models\Members;

use App\Models\General\Status;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['status_id','created_by', 'updated_by'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }


    /**
     * @return array
     */
    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
