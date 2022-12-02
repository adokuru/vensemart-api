 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vensemart | Dashboard</title>
   @include('includeFile.head')
</head>
<body class="hold-transition sidebar-mini">
    <style>
        .main-sidebar .brand-image {
    min-height: 35px!important;
    width: 35px!important;
    object-fit: contain;
    padding: 4px;
    background-color: #fff;
}
    </style>
<div class="wrapper">
  <!-- Navbar -->
 @include('includeFile.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/dashboard')}}" class="brand-link">
      <img src="{{url('public/assets')}}/vensemart(logo).jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Vensemart</span>
    </a>

    <!-- Sidebar -->
    @include('includeFile.leftmenu')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
    @yield('content')
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022-2023 <a href="javascript:void(0);">Pontus</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->
<!-- Change password panel start -->
  
<!-- Modal -->
<div class="modal fade" id="changepassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="message" class="text-center"></div>
            <form action="javascript:void(0);" id="form1" method="post">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
              <div class="form-group">
                <label for="npass">New password</label>
                <input type="text" class="form-control" name="npass" id="npass" placeholder="New password">
              </div>
              <div class="form-group">
                <label for="confpass">confirm password</label>
                <input type="text" class="form-control" name="confpass" id="confpass" placeholder="confirm password">
              </div>
              <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                <input type="submit" class="btn btn-primary btn-lg btn-block" id="changepass" value="submit"/>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>
<!-- Change password panel end -->

<!-- REQUIRED SCRIPTS -->
   @include('includeFile.footer')
   
   @yield('customJS')
   
  <script>


  @if(Session::has('success'))
  		toastr.success("{{ Session::get('success') }}");
  @endif


  @if(Session::has('info'))
  		toastr.info("{{ Session::get('info') }}");
  @endif


  @if(Session::has('warning'))
  		toastr.warning("{{ Session::get('warning') }}");
  @endif


  @if(Session::has('error'))
  		toastr.error("{{ Session::get('error') }}");
  @endif


</script> 
   
   
   
   
   
<!-- ajax call   -->
<script>
    $(document).ready(function () {
       $("#changepass").click(function (event) {
                event.preventDefault();
                var form = $('#form1')[0];
                var data = new FormData(form);
               // var status =true;
                
                if($("#npass").val() == ""){
                    $("#message").html("<span class='text-danger'>Enter new password</span>");
                    return false;
                } else {
                    $("#message").html("");
                } 
                if($("#confpass").val() == ""){
                    $("#message").html("<span class='text-danger'>Enter confrim password</span>");
                    return false;
                } else {
                    /*$("#message").html("");
                }
                if($("#confpass").val() != $("#npass").val("")){
                    $("#message").html("<span class='text-danger'>New password are not match with confrim password</span>");
                    return false;
                } else {*/
                    $("#message").html("");
                $.ajax({
                            type: "POST",
                            enctype: 'multipart/form-data',
                            url: "<?php echo URL::to('Admin/changepass'); ?>",
                            data: data,
                            processData: false,
                            contentType: false,
                            cache: false,
                            timeout: 800000,
                            success: function (data) {
                                //alert(data);
                                $("#message").html(data);
                                form1.reset();
                                    return false;
                            },
                            error: function (e) {
                                console.log("ERROR : ", e);
                                $("#changepass").prop("disabled", false);
                            }
                        });
                    }    
  });
  
  $(".close").click(function(){
    $("#message").html("");
  });
});
  </script>  
<!--ajax call end  -->

</body>
</html>