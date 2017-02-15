<script>
    var config = {
        routes: {},
        messages: {
            deletemsg: "{{ trans('global.deletemsg') }}"
        },
        others: {
            csrf: "{{ csrf_token() }}",
            deletemsg: "{{ trans('global.deletemsg') }}"
        }
    }
</script>
<script src="{{ URL::asset('js/app.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $('input').not('.no-icheck').iCheck({
        checkboxClass: 'icheckbox_flat-red',
        radioClass: 'iradio_flat-red'
      });
      $('[data-toggle="tooltip"]').tooltip();
    });
    $(document).ajaxComplete(function(){
      $('input').iCheck({
        checkboxClass: 'icheckbox_flat-red',
        radioClass: 'iradio_flat-red'
      });
    });
</script>
