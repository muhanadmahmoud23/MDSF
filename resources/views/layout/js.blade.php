    <!-- Loader -->
    {{-- <div class="loader-overlay"></div> --}}

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/atrana.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper/popper.min.js') }}"></script>

    <!-- Chart Js -->
    <script src="{{ asset('assets/modules/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/ui-apexcharts.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script src="{{ asset('assets/hand/jquery.min.js') }}"></script>
    {{-- charts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD',
                defaultDate: new Date(),
                maxDate: new Date(),
                useCurrent: false,
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker2').datetimepicker({
                format: 'YYYY-MM-DD',
                defaultDate: new Date(),
                maxDate: new Date(),
                useCurrent: false,
            });
        });
    </script>
