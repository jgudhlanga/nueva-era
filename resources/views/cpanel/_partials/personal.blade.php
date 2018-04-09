<div class="row">
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ route('cpanel.general.manager', ['Gender']) }}">
            @choice('general.gender.heading', 1)
            &nbsp;<span class="badge">{{$genderCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ route('cpanel.general.manager', ['MemberType']) }}">
            @choice('general.member_types.heading', 2)
            &nbsp;<span class="badge">{{$memberTypeCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ route('cpanel.general.manager', ['MaritalStatus']) }}">
            @choice('general.marital_statuses.heading', 2)
            &nbsp;<span class="badge">{{$maritalStatusCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ route('cpanel.general.manager', ['Occupation']) }}">
            @choice('general.occupations.heading', 2)
            &nbsp;<span class="badge">{{$occupationCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ route('cpanel.general.manager', ['Race']) }}">
            @choice('general.races.heading', 2)
            &nbsp;<span class="badge">{{$raceCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ route('cpanel.general.manager', ['Title']) }}">
            @choice('general.titles.heading', 2)
            &nbsp;<span class="badge">{{$titleCount}}</span>
        </a>
    </div>
</div>
