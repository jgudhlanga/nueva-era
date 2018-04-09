<div class="col-md-6">
    <div class="form-group">
        <label for="application_type_id" class="col-md-3 control-label text-left">
            @choice('general.type', 1)
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            <select name="application_type_id" id="application_type_id" class="form-control input-sm" required>
                <option value="">@lang('forms.choose')</option>
                @if(count($applicationTypes) > 0)
                    @foreach($applicationTypes as $type)
                        <option value="{{$type->id}}"
                                @isset($member) @if($member->application_type_id == $type->id) selected @endif @endisset>
                            {{$type->name}}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="title_id" class="col-md-3 control-label text-left">@lang('general.people.title')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            <select name="title_id" id="title_id" class="form-control input-sm" required>
                <option value="">@lang('forms.choose')</option>
                @if(count($titles) > 0)
                    @foreach($titles as $title)
                        <option value="{{$title->id}}"
                                @isset($member) @if($member->title_id == $title->id) selected @endif @endisset>
                            {{$title->name}}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="title_id" class="col-md-3 control-label text-left">@lang('general.people.gender')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            @if(count($genders) > 0)
                @foreach($genders as $gender)
                    <div class="radio radio-success radio-inline">
                        <input type="radio" id="gender_{{$gender->id}}" value="{{$gender->id}}" name="gender_id" required
                               @isset($member) @if($member->gender_id == $gender->id) checked @endif @endisset >
                        <label for="gender_{{$gender->id}}">{{$gender->name}}</label>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="first_name" class="col-md-3 control-label text-left">@lang('general.people.first_name')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="first_name" id="first_name" required
                   value="@isset($member) {{$member->first_name}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="middle_name" class="col-md-3 control-label text-left">@lang('general.people.middle_name')</label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="middle_name" id="middle_name"
                   value="@isset($member) {{$member->middle_name}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="last_name" class="col-md-3 control-label text-left">@lang('general.people.last_name')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="last_name" id="last_name" required
                   value="@isset($member) {{$member->last_name}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="birth_date" class="col-md-3 control-label text-left">
            @lang('general.people.birth_date')</label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="birth_date" id="birth_date"
                   value="@isset($member) {{$member->birth_date}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="birth_place" class="col-md-3 control-label text-left">
            @lang('general.people.birth_place')</label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="birth_place" id="birth_place"
                   value="@isset($member) {{$member->birth_place}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="occupation_id" class="col-md-3 control-label text-left">
            @choice('general.occupations.heading', 1)
        </label>
        <div class="col-md-9">
            <select name="occupation_id" id="occupation_id" class="form-control input-sm">
                <option value="">@lang('forms.choose')</option>
                @if(count($occupations) > 0)
                    @foreach($occupations as $occupation)
                        <option value="{{$occupation->id}}"
                                @isset($member) @if($member->occupation_id == $occupation->id) selected @endif @endisset>
                            {{$occupation->name}}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>


