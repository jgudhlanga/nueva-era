<div class="row">
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ route('cpanel.general.manager', ['AddressType']) }}">
            @choice('general.address_types.heading', 2)
            &nbsp;<span class="badge">{{$addressTypeCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ route('cpanel.general.manager', ['ApplicationType']) }}">
            @choice('general.application_types.heading', 2)
            &nbsp;<span class="badge">{{$applicationTypeCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ url('cpanel/general/countries') }}">
            @choice('countries.title', 2)
            &nbsp;<span class="badge">{{$countryCount}}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ route('cpanel.general.manager', ['Language']) }}">
            @choice('general.language', 2)
            &nbsp;<span class="badge">{{ $languageCount }}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ route('cpanel.general.manager', ['Interest']) }}">
            @choice('general.interest', 2)
            &nbsp;<span class="badge">{{ $interestCount }}</span>
        </a>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ route('cpanel.general.manager', ['Icon']) }}">
            {{trans('cpanel.menu_icons')}}
            &nbsp;<span class="badge">{{$iconCount}}</span>
        </a>
    </div>
</div>
<div class="row margin-top-5">
    <div class="col-sm-2">
        <a class="btn btn-default btn-sm btn-block text-bold"
           href="{{ route('cpanel.general.manager', ['Status']) }}">
            {{trans('cpanel.status')}}
            &nbsp;<span class="badge">{{$statusCount}}</span>
        </a>
    </div>
</div>
