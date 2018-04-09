<?php

namespace App\Services\Members;


use App\Repositories\Members\MemberRepository;

/**
 * Class MemberService
 * @package App\Services\Members
 */
class MemberService
{
    /**
     * @var MemberRepository
     */
    protected $memberRepository;

    /**
     * MemberService constructor.
     * @param MemberRepository $memberRepository
     */
    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->memberRepository->find($id);
    }

    /**
     * @param array $where
     * @param null $paginate
     * @param null $limit
     * @param null $orderBy
     * @return mixed
     */
    public function findAll($where = [], $paginate = null, $limit = null, $orderBy = null)
    {
        return $this->memberRepository->findAll($where, $paginate, $limit, $orderBy);
    }

    /**
     * @param array $columns
     * @param array $where
     * @param null $paginate
     * @param null $limit
     * @param null $orderBy
     * @return mixed
     */
    public function findBy($columns=[], $where = [], $paginate = null, $limit = null, $orderBy = null)
    {
        return $this->memberRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function create($params)
    {
        return $this->memberRepository->create($params);
    }

    /**
     * @param $member
     * @param $data
     * @return mixed
     */
    public function update($member, $data)
    {
        return $this->memberRepository->update($member, $data);
    }

    /**
     * @param $member
     * @return mixed
     */
    public function delete($member)
    {
        return $this->memberRepository->delete($member);
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function count($where = [])
    {
        return $this->memberRepository->count($where);
    }
}