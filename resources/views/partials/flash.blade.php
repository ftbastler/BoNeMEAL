@if (session('message'))
    <script>
        var dialog = BootstrapDialog.show({
            title: "{{ trans('app.notice') }}",
            message: "{{ session('message') }} @if (session('messageDetails'))<br /><br /><p>{{ trans('app.details') }}:<br />{{ session('messageDetails') }}</p>@endif",
            buttons: [{
                label: "{{ trans('app.ok') }}",
                action: function(dialog) {
                    dialog.close();
                }
            }]
        });
        setTimeout(function() {
            dialog.close();
        }, 6000);
    </script>
@endif
