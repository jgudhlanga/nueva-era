@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">@lang('general.create') @choice('members.member', 1)</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('members.index') }}">
                    <i class="fa fa-home"></i>
                        @choice('members.member', 2)
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <form id="addMemberForm" role="form" data-toggle="validator" method="POST" action="{{route('members.store')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                @include('members._partials.forms.member-fields')
                @include('members._partials.forms.contact_details')
                @include('members._partials.forms.interests')
                <div class="col-md-12  text-center">
                    <div class="padding-top-5">
                        <a class="btn btn-default" type="button" href="{{route('members.index')}}">
                            <i class="{{config('buttons.icons.back')}}"></i>&nbsp;@lang('buttons.back')
                        </a>
                        <button class="btn btn-success" type="submit">
                            <i class="{{config('buttons.icons.save')}}"></i>&nbsp;@lang('buttons.save')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    @include('members.assets.members-js')
@endsection