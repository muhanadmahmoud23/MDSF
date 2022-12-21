<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/kendou/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper/popper.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<!-- General JS Scripts -->
<script src="{{ asset('assets/js/atrana.js') }}"></script>
<!-- JS Libraies -->
<script src="{{ asset('assets/kendou/examples/content/shared/js/products.js') }}"></script>
<!-- Chart Js -->
<script src="{{ asset('assets/modules/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/js/ui-apexcharts.js') }}"></script>
<!-- Template JS File -->
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
{{-- charts --}}
<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2@11') }}"></script>
<script src="{{ asset('assets/js/virtual-select.min.js') }}"></script>
<script src="{{ asset('assets/kendou//js/kendo.all.min.js') }}"></script>
<script src="{{ asset('assets/kendou/content/shared/js/console.js') }}"></script>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: new Date(),
            maxDate: new Date(),
            useCurrent: false,
        });
    });
    
    $(function () {
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: new Date(),
            maxDate: new Date(),
            useCurrent: false,
        });
    });
</script>