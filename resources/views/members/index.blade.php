@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">{{trans('members.list')}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}">
                    <i class="fa fa-dashboard"></i>{{trans('general.dashboard')}}</a></li>
        </ol>
    </section>
    <section class="content">

    </section>
@endsection