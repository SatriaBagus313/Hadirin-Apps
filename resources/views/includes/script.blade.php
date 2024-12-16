<!-- General JS Scripts -->
<script src="{{asset('js/app.min.js')}}"></script>
  <!-- JS Libraies -->
  <script src="{{asset('bundles/echart/echarts.js')}}"></script>
  <script src="{{asset('bundles/chartjs/chart.min.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('js/page/index.js')}}"></script>
  <!-- Template JS File -->
  <script src="{{asset('js/scripts.js')}}"></script>
  
  <!-- myscript -->
  <!-- Custom JS File -->
  <script src="{{asset('js/custom.js')}}"></script>
  <script src="{{asset('bundles/cleave-js/dist/cleave.min.js')}}"></script>
  <script src="{{asset('bundles/cleave-js/dist/addons/cleave-phone.us.js')}}"></script>
  <script src="{{asset('bundles/jquery-pwstrength/jquery.pwstrength.min.js')}}"></script>
  <script src="{{asset('bundles/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
  <script src="{{asset('bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
  <script src="{{asset('bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
  <script src="{{asset('bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
  <script src="{{asset('bundles/select2/dist/js/select2.full.min.js')}}"></script>
  <script src="{{asset('bundles/jquery-selectric/jquery.selectric.min.js')}}"></script>
  

  <script src="{{asset('js/page/forms-advanced-forms.js')}}"></script>
  <script src="{{asset('bundles/izitoast/js/iziToast.min.js')}}"></script>

  <script>
  
  $(document).ready(function() {
    const flashData = $("#flash-data").data('flashdata');
    console.log('flash-data',flashData);
    // if(flashData === "Maaf sisa cuti anda sudah habis"){
        
    //     iziToast.error({
    //         title: 'Error!',
    //         message: flashData,
    //         position: 'topRight'
    //     });

    // }
    if(flashData){
        iziToast.success({
            title: 'Success !!',
            message: flashData,
            position: 'topRight'
        });
    }
  });
  </script>
