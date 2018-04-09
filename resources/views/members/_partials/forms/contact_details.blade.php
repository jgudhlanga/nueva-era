<div class="col-md-6">
    <div class="caption-title-div">
        <div class="caption-title">@lang('general.contact_details')</div>
    </div>
    <div class="form-group">
        <label for="email" class="col-md-3 control-label text-left">@lang('general.email')
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="email" id="email" required
                   value="@isset($member) {{$member->email}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="alt_email" class="col-md-3 control-label text-left">
            @lang('general.alt') @lang('general.email')
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="alt_email" id="alt_email"
                   value="@isset($member) {{$member->alt_email}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="mobile" class="col-md-3 control-label text-left">@lang('general.people.cell_number')</label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="mobile" id="mobile"
                   value="@isset($member) {{$member->mobile}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="alt_mobile" class="col-md-3 control-label text-left">
            @lang('general.alt') @lang('general.people.cell_number')
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="alt_mobile" id="alt_mobile"
                   value="@isset($member) {{$member->alt_mobile}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="telephone" class="col-md-3 control-label text-left">
            @lang('general.telephone')
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="telephone" id="telephone"
                   value="@isset($member) {{$member->telephone}} @endisset">
        </div>
    </div>
    <div class="form-group">
        <label for="alt_telephone" class="col-md-3 control-label text-left">
            @lang('general.alt') @lang('general.telephone')
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control input-sm" name="alt_telephone" id="alt_telephone"
                   value="@isset($member) {{$member->alt_telephone}} @endisset">
        </div>
    </div>
</div>