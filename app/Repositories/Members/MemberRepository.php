<?php

namespace App\Repositories\Members;

use App\Contracts\RepositoryInterface;
use App\Models\Members\Member;
use Illuminate\Support\Facades\DB;

/**
 * Class MemberRepository
 * @package App\Repositories\Members
 */
class MemberRepository implements RepositoryInterface
{
    /**
     * @var Member
     */
    protected $member;

    /**
     * MemberRepository constructor.
     * @param Member $member
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->member->where('id', $id)->first();
    }

    /**
     * @param array $columns
     * @param array $where
     * @param null $paginate
     * @param null $limit
     * @param null $orderBy
     * @return mixed
     */
    public function findBy($columns=[], $where=[], $paginate=null, $limit=null, $orderBy=null )
    {

        $query = DB::table('members AS m');
        if (!empty($columns)) {
            $cols = "";
            foreach ($columns as $column) {
                $cols .= "m.{$column},";
            }
            $query->select(rtrim(',', $cols));
        } else {
            $query->select('m.*');
        }

        if(!empty($where) && is_array($where))
        {
            for ($i=0; $i<count($where); $i++)
            {
                if(is_array(array_values($where)[$i])){
                    $query->wherein(array_keys($where)[$i],array_values($where)[$i]);
                }
                else{
                    $query->where(array_keys($where)[$i], '=', array_values($where)[$i]);
                }
            }
        }

        if($orderBy != '')
        {
            if(is_array($orderBy)){
                $query->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
            }
        }
        else{
            $query->orderBy('created_at', 'asc')->take($limit);
        }

        if (!is_null($paginate)) {
            $query->paginate($paginate);
        }
        return $query->with('status')->get();
    }

    /**
     * @param array $where
     * @param null $paginate
     * @param null $limit
     * @param null $orderBy
     * @return mixed
     */
    public function findAll( $where=[], $paginate=null, $limit=null, $orderBy=null )
    {
        $members = $this->member->where('id', '>', 0);
        if(!empty($where) && is_array($where))
        {
            for ($i=0; $i<count($where); $i++)
            {
                if(is_array(array_values($where)[$i])){
                    $members->wherein(array_keys($where)[$i],array_values($where)[$i]);
                }
                else{
                    $members->where(array_keys($where)[$i], '=', array_values($where)[$i]);
                }
            }
        }

        if($orderBy != '')
        {
            if(is_array($orderBy)){
                $members->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
            }
        }
        else{
            $members->orderBy('created_at', 'asc')->take($limit);
        }

        if (!is_null($paginate)) {
            $members->paginate($paginate);
        }

        return $members->get();
    }

    /**
     * @param $member
     * @return mixed
     */
    public function delete($member)
    {
        return $member->delete();
    }


    /**
     * @return array
     */
    public function getTableColumns()
    {
        return $this->member->getTableColumns();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function create($params)
    {
        $columns = $this->getTableColumns();
        $data = [];
        foreach ( $columns as $column ) {
            if($column == 'id' || $column == 'created_at'|| $column == 'updated_at' || $column == 'status_id' ) {
                continue;
            }
            $data[$column] = (isset($params[$column]) && $params[$column] != '') ? $params[$column] : NULL;
        }
        $created = Member::create($data);
        return $created;
    }

    /**
     * @param $member
     * @param $data
     * @return mixed
     */
    public function update($member, $data)
    {
        $member->update($data);
        return $member;
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function count($where = [])
    {
        $count = $this->member->where('id', '>', 0);
        if(!empty($where) && is_array($where))
        {
            for ($i=0; $i<count($where); $i++)
            {
                if(is_array(array_values($where)[$i])){
                    $count->wherein(array_keys($where)[$i],array_values($where)[$i]);
                }
                else{
                    $count->where(array_keys($where)[$i], '=', array_values($where)[$i]);
                }
            }
        }

        return $count->count();
    }
}