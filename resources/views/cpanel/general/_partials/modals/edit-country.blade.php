<div class="modal fade" id="editCountryModal" tabindex="-1" role="dialog" aria-labelledby="editCountryModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editCountryForm"  role="form" data-toggle="validator">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <input type="hidden" name="edit_id" id="edit_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">
                        {{trans('countries.edit')}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="modal-close-btn">&times;</span>
                        </button>
                    </h3>
                </div>
                <div class="modal-body">
                    @include('cpanel.general._partials.forms.country-fields')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>&nbsp;{{trans('buttons.close')}}
                    </button>
                    <button type="submit" class="btn btn-success"  id="btnUpdate">
                        <i class="fa fa-save"></i>&nbsp;{{trans('buttons.update')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>