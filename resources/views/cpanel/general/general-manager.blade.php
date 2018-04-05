@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">
            {{$model}} @choice('general.setting', 2)
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('cpanel') }}">
                    <i class="fa fa-chevron-circle-left"></i>{{trans('cpanel.c_panel')}}
                </a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="pull-right margin-bottom-5 margin-left-5">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addGeneralModal">
                <i class="fa fa-plus-circle"></i> {{ trans('buttons.add_new') }}
            </button>
        </div>
        <table class="table table-striped" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>@choice('general.name', 1)</th>
                <th>@lang('general.description')</th>
                <th>@lang('general.status')</th>
                <th class="text-right">@lang('general.action')</th>
            </tr>
            </thead>
            @if(count($data) > 0)
                @foreach($data as $row)
                    <tr>
                        <td>{{$row->name}}</td>
                        <td>{{$row->description}}</td>
                        <td>{{$row->status->name ?? ''}}</td>
                        <td class="text-right">
                            <button class="btn btn-info btn-xs" id="btnEdit"
                                    onclick='return editGeneral("{{$row->id}}}")'>
                                <i class="fa fa-edit"></i> {{trans('buttons.edit')}}
                            </button>
                            <?php
                            $newStatus = ($row->status_id == $statusActive) ? $statusInActive : $statusActive;
                            $btnClass = ($row->status_id == $statusActive) ? 'btn-warning' : 'btn-success';
                            $toggleClass = ($row->status_id == $statusActive) ? 'fa fa-toggle-off' : 'fa fa-toggle-on';
                            $toggleTitle = ($row->status_id == $statusActive) ? trans('buttons.deactivate') : trans('buttons.reactivate');
                            ?>
                            <button class="btn {{$btnClass}} btn-xs"
                                    onclick='return changeStatus("{{$row->id}}", "{{$newStatus}}")'>
                                <i class="{{$toggleClass}}"></i> {{$toggleTitle}}
                            </button>
                            <button class="btn btn-danger btn-xs"
                                    onclick='return deleteGeneral("{{$row->id}}")'>
                                <i class="fa fa-trash"></i> {{trans('buttons.delete')}}
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">
                        <div class="text-danger text-center">{{trans('general.no_records_found')}}</div>
                    </td>
                </tr>
            @endif
        </table>
    </section>
    @include('cpanel.general._partials.modals.add-general')
    @include('cpanel.general._partials.modals.edit-general')
    @include('cpanel.general.assets.js.general-js')
@endsection