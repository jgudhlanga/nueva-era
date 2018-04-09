<?php

namespace App\Http\Controllers\Members;

use App\Services\General\StatusService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\People\PeopleTrait;
use App\Services\Members\MemberService;

class MembersController extends Controller
{
    use PeopleTrait;

    protected $memberService;

    protected $statusService;

    public function __construct(MemberService $memberService, StatusService $statusService)
    {
        $this->memberService = $memberService;
        $this->statusService = $statusService;
    }

    public function index()
    {
        return view('members.index');
    }


    public function create()
    {
        $args = [
            'titles' => $this->titleOptions(), 'genders' => $this->genderOptions(),
            'applicationTypes' => $this->applicationTypeOptions(),
            'occupations' => $this->occupationOptions()
        ];
        return view('members.create')->with($args);
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
