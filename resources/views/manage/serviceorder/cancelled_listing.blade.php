@extends('app')

@section('content')
 <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           
            <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Cancelled Service Order Listing</h3>
             <div class=" ml-auto w-75 text-right ">
             
             </div>
          </div>
          <style>
              td, th {
           user-select: none;
          -webkit-user-select: none;
          -moz-user-select: -moz-none;
          -ms-user-select: none; 
        }
          </style>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>S.No.</th>
                <th>booking_id</th>
                <th>Name</th>
                <!-- <th>Email</th> -->
               <th>Booking Time</th>
                <th>Booking Date</th>
                <th>Service</th>
                <!-- <th>Payment Status</th>
                <th>Order Status</th> -->
                
                <!-- <th>Action</th> -->
              </tr>
              </thead>
              <tbody>
              <?php if($listing){ $i=1; foreach($listing as $val){?>      
              <tr>
                <td>{{  $i }}</td>


                <td>{{ $val->booking_id }}</td>
                <td>{{ $val->user_name ?? 'James'}}</td>
                <!-- <td>{{ $val->user_id ?? ''}}</td> -->
                <!-- <td>{{ $val->user_email ?? ''}}</td> -->

                <!-- <td>{{ $val->price ?? ''}}</td> -->
                <td>{{ $val->booking_time ?? 'No Time' }}</td>
                <td>{{ $val->booking_date  ?? 'No Date' }}</td>
                <td>
                  <?php if($val->service_type == 1)
                       {?> <span class="">Saloon</span> <?php } 
                       elseif($val->service_type == 2)
                       {?> <span class="">Hair and Nails</span> <?php } 
                       elseif($val->service_type == 3)
                       {?> <span class="">Men's Therapy</span> <?php } 
                       elseif($val->service_type == 6)
                       {?> <span class="">CCTV Installer</span> <?php } 
                       elseif($val->service_type == 7)
                       {?> <span class="">Solar Installer</span> <?php } 
                       elseif($val->service_type == 8)
                       {?> <span class="">Inverter Installer</span> <?php } 
                       elseif($val->service_type == 10)
                       {?> <span class="">AC Repairer</span> <?php } 
                       elseif($val->service_type == 11)
                       {?> <span class="">Barber</span> <?php } 
                       elseif($val->service_type == 12)
                       {?> <span class="">Generator Repairer</span> <?php } 
                       elseif($val->service_type == 13)
                       {?> <span class="">Car Mechanic</span> <?php } 
                       elseif($val->service_type == 14)
                       {?> <span class="">Janitors/Cleaners</span> <?php } 
                       elseif($val->service_type == 15)
                       {?> <span class="">Masseuse/SPA</span> <?php } 
                       elseif($val->service_type == 16)
                       {?> <span class="">Electronic Repairer</span> <?php } 
                       elseif($val->service_type == 17)
                       {?> <span class="">Painter</span> <?php } 
                       elseif($val->service_type == 18)
                       {?> <span class="">POP Installer</span> <?php } 
                       elseif($val->service_type == 20)
                       {?> <span class="">Tiler</span> <?php } 
                       elseif($val->service_type == 21)
                       {?> <span class="">Welder</span> <?php } 
                       elseif($val->service_type == 22)
                       {?> <span class="">Plumber</span> <?php } 
                       
                       elseif($val->service_type == 23)
                       {?> <span class="">Carpenter</span> <?php } 
                       
                       elseif($val->service_type == 24)
                       {?> <span class="">Laundry</span> <?php } 
                       
                       elseif($val->service_type == 25)
                       {?> <span class="">Panel Beater</span> <?php } 
                       
                       elseif($val->service_type == 26)
                       {?> <span class="">AC Installer</span> <?php } 
                       
                       elseif($val->service_type == 27)
                       {?> <span class="">Pedicure and Manicure (Pedicurist)</span> <?php } 
                       
                       elseif($val->service_type == 28)
                       {?> <span class="">Electrician</span> <?php } 
                       
                       elseif($val->service_type == 29)
                       {?> <span class="">Fridge Repairer</span> <?php } 


                       elseif($val->service_type == 30)
                       {?> <span class="">Aliminum door/window Installer</span> <?php } 
                       
                       elseif($val->service_type == 31)
                       {?> <span class="">Safety and Fire Alarm System Installer</span> <?php }
                       
                       elseif($val->service_type == 32)
                       {?> <span class="">Bricklayer</span> <?php }
                       elseif($val->service_type == 33)
                       {?> <span class="">Dish Installer</span> <?php }
                       elseif($val->service_type == 34)
                       {?> <span class="">Tailor</span> <?php }   

                       elseif($val->service_type == 37)
                       {?> <span class="">CCTV, SOLAR and INVERTER</span> <?php }  
                       
                       elseif($val->service_type == 38)
                       {?> <span class="">Make-up Artist</span> <?php }  


                       elseif($val->service_type == 39)
                       {?> <span class="">Gele Tie</span> <?php }  


                       elseif($val->service_type == 40)
                       {?> <span class="">Television Repairer</span> <?php }  
                       

                       elseif($val->service_type == 41)
                       {?> <span class="">Photographer and Videographer</span> <?php }  
                       

                       elseif($val->service_type == 42)
                       {?> <span class="">Welder</span> <?php }  


                       elseif($val->service_type == 43)
                       {?> <span class=""> Honda Car Mechanic</span> <?php }  



                       elseif($val->service_type == 44)
                       {?> <span class="">  Toyota Mechanic</span> <?php }  




                       elseif($val->service_type == 45)
                       {?> <span class="">  Ford Mechanic</span> <?php } 



                       elseif($val->service_type == 46)
                       {?> <span class="">   Kia Mechanic</span> <?php } 
                       


                       elseif($val->service_type == 47)
                       {?> <span class="">   Nissan Car Mechanic</span> <?php } 


                       elseif($val->service_type == 49)
                       {?> <span class="">   Cake & Pastries Maker</span> <?php } 



                       elseif($val->service_type == 50)
                       {?> <span class="">   Panel Beater</span> <?php } 



        
                       elseif($val->service_type == 51)
                       {?> <span class="">    Auto Electrician</span> <?php } 


                       elseif($val->service_type == 52)
                       {?> <span class="">    Japanese Car Mechanic</span> <?php } 


                       elseif($val->service_type ==53)
                       {?> <span class="">     Shoe Cobbler</span> <?php } 

                       
                     
          
                       else{?> <span class="">No Service Chosen</span> <?php }
                    ?></td>


                <!-- <td>{{ $valprice ?? ''}}</td> -->
               
               
              </tr>
              <?php $i++; }}?>
              </tbody>
             
            </table>
          </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@stop

@section('customJS')
<script>
  $(function () {
    // $("#example1").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": true,
    //   "buttons": ["csv", "excel", "pdf", "print"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
  
  

    function change_status(d_id,a){
        var status_val  =a.value;
     
          $.ajax({

            type: "GET",

            dataType: "json",

            url: '{{ url('admin/new_driver/change_status_of_driver') }}',

            data: {'is_vaify_val': status_val, 'd_id': d_id},

            success: function(data){
                //console.log(data);
            location.reload();
            }

        });
    }

</script>
@stop