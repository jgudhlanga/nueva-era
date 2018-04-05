<script>
    $(document).ready(function () {

        /*
        * SAVE
        * */
        $('#addGeneralForm').validator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                swal({
                    title: "{{ trans('alerts.error') }}",
                    text: "{{ trans('alerts.form_error') }}",
                    type: "error",
                    allowOutsideClick: false
                });
            }
            else {
                e.preventDefault();
                waitBusy('app_wrapper', '{{config('waitme.success')}}');
                var url = '{{ route("cpanel.general.store", [$model]) }}';
                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#addGeneralForm').serialize()
                })
                    .success(function (res) {
                        if (res.data.id) {
                            $('#addGeneralModal').modal('hide');
                            swal("{{ trans('alerts.created') }}",
                                res.message,
                                "success"
                            ).then(function () {
                                $('#app_wrapper').waitMe('hide');
                                location.reload(true);
                            });
                        }
                    })
                    .error(function (res) {
                        var arr = Object.entries(res.responseJSON.errors);
                        var message = '';
                        for (i = 0; i < arr.length; i++) {
                            message += "<br>" + arr[i][1];
                        }
                        $('#app_wrapper').waitMe('hide');
                        swal("{{ trans('alerts.error') }}", message, "error");
                    });
            }
        });

        /** UPDATE*/
        $('#editGeneralForm').validator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                swal({
                    title: "{{ trans('alerts.error') }}",
                    text: "{{ trans('alerts.form_error') }}",
                    type: "error",
                    allowOutsideClick: false
                });
            }
            else {
                e.preventDefault();
                waitBusy('app_wrapper', '{{config('waitme.success')}}');
                var url = '{{ route("cpanel.general.update", [$model,':id']) }}';
                url = url.replace(':id', $('#edit_id').val());
                $.ajax({
                    url: url,
                    type: "PUT",
                    data: $('#editGeneralForm').serialize()
                })
                    .success(function (res) {
                        console.log(res);
                        if (res.data.id) {
                            swal("{{ trans('alerts.updated') }}",
                                res.message,
                                "success"
                            ).then(function () {
                                $('#app_wrapper').waitMe('hide');
                                location.reload(true);
                            });
                        }
                    })
                    .error(function (data) {
                        $('#app_wrapper').waitMe('hide');
                        swal("{{ trans('alerts.error') }}", data.responseJSON.message, "error");
                    });
            }
        });
    });

    /*
    * EDIT SHOW
    * */
    function editGeneral(id) {
        $('#editGeneralModal').modal('show');
        waitBusy('editGeneralModal', '{{config('waitme.info')}}');
        var url = '{{ route("cpanel.general.edit", [$model,':id']) }}';
        url = url.replace(':id', id);
        var data = {'id': id};
        $.ajax({
            url: url,
            type: "GET",
            data: data
        })
            .success(function (res) {
                $('#editGeneralModal').waitMe('hide');
                //populate form fields
                $('#btnUpdate').removeClass('disabled');
                $('#edit_id').val(res.data.id);
                $('#editGeneralForm #name').val(res.data.name);
                $('#editGeneralForm #description').val(res.data.description);
            })
            .error(function (res) {
                console.log('There is an error');
            })
    }

    /**
     * DELETE
     * @param id
     */
    function deleteGeneral(id) {
        swal({
            title: "{{ trans('alerts.confirm') }}",
            text: "{{ trans('alerts.delete_text') }}",
            type: 'question',
            showCancelButton: true,
            confirmButtonClass: "{{ config('sweetalerts.confirm_button_class') }}",
            cancelButtonColor: "{{ config('sweetalerts.confirm_button_color') }}",
            confirmButtonText: "{{ trans('alerts.confirm_button_text') }}"
        })
            .then(function (result) {
                if (result.value) {
                    console.log(id);
                    waitBusy('app_wrapper', '{{config('waitme.danger')}}');
                    var url = '{{ route("cpanel.general.destroy", [$model,':id']) }}';
                    url = url.replace(':id', id);
                    var data = {'_token': "{{ csrf_token() }}"};
                    $.ajax({
                        url: url,
                        type: "DELETE",
                        data: data
                    })
                        .success(function (data) {
                            $('#app_wrapper').waitMe('hide');
                            swal("{{ trans('alerts.deleted') }}",
                                "{{trans('alerts.after_delete_text')}}",
                                "success")
                                .then(function () {
                                    location.reload(true);
                                });
                        })
                        .error(function (data) {
                            $('#app_wrapper').waitMe('hide');
                            swal("{{ trans('alerts.error') }}", data.responseJSON.response, "error");
                        });
                }
            });
    }

    /**
     * CHANGE STATUS
     * @param id
     */
    function changeStatus(id) {
        swal({
            title: "{{ trans('alerts.confirm') }}",
            text: "{{ trans('alerts.change_status_text') }}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: "{{ config('sweetalerts.confirm_button_class') }}",
            cancelButtonColor: "{{ config('sweetalerts.confirm_button_color') }}",
            confirmButtonText: "{{ trans('alerts.confirm_button_text') }}"
        })
            .then(function (result) {
                if (result.value) {

                    waitBusy('app_wrapper', '{{config('waitme.info')}}');

                    var url = '{{ route('cpanel.general.change_status', [$model, ':id']) }}';
                    url = url.replace(':id', id);
                    var data = {'_token': "{{ csrf_token() }}"};
                    $.ajax({
                        url: url,
                        type: "PUT",
                        data: data
                    })
                        .success(function (data) {

                            $('#app_wrapper').waitMe('hide');

                            swal("{{ trans('alerts.status_changed') }}",
                                data.message,
                                "success")
                                .then(function () {
                                    location.reload(true);
                                });
                        })
                        .error(function (data) {

                            $('#app_wrapper').waitMe('hide');

                            swal("{{ trans('alerts.error') }}", data.responseJSON.response, "error");
                        });
                }
            });
    }
</script>
