@extends('app')

@section('content')
 <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           
            <!-- /.card -->

      <div class="card ">
            <div class="card-header bg-dark mt-0">
                <h3 class="card-title">View Existing Service Provider</h3>
            </div>
              <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
               <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                    <span>Name </span> <span>{{$listing->name}}</span> 
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Email </span> <span>{{$listing->email}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Mobile </span> <span>{{$listing->mobile}}</span> 
                </li>


                <li class="list-group-item d-flex justify-content-between">
                    <span>Service Type</span> 
                    <?php if($listing->service_type == 1)
                       {?> <span class="badge badge-success">Saloon</span> <?php } 
                      elseif($listing->service_type == 2)
                       {?> <span class="badge badge-success">Hair and Nails</span> <?php } 
                       elseif($listing->service_type ==3)
                       {?> <span class="badge badge-success">Men's Therapy</span> <?php } 
                       elseif($listing->service_type == 6)
                       {?> <span class="badge badge-success">CCTV Installer</span> <?php } 
                       elseif($listing->service_type == 7)
                       {?> <span class="badge badge-success">Solar Installer</span> <?php } 
                       elseif($listing->service_type == 8)
                       {?> <span class="badge badge-success">Inverter Installer</span> <?php } 
                       elseif($listing->service_type == 10)
                       {?> <span class="badge badge-success">AC Repairer</span> <?php } 
                       elseif($listing->service_type == 11)
                       {?> <span class="badge badge-success">Barber</span> <?php } 
                       elseif($listing->service_type == 12)
                       {?> <span class="badge badge-success">Generator Repairer</span> <?php } 
                       elseif($listing->service_type == 13)
                       {?> <span class="badge badge-success">Car Mechanic</span> <?php } 
                       elseif($listing->service_type == 14)
                       {?> <span class="badge badge-success">Janitors/Cleaners</span> <?php } 
                       elseif($listing->service_type == 15)
                       {?> <span class="badge badge-success">Masseuse/SPA</span> <?php } 
                       elseif($listing->service_type == 16)
                       {?> <span class="badge badge-success">Electronic Repairer</span> <?php } 
                       elseif($listing->service_type == 17)
                       {?> <span class="badge badge-success">Painter</span> <?php } 
                       elseif($listing->service_type == 18)
                       {?> <span class="badge badge-success">POP Installer</span> <?php } 
                       elseif($listing->service_type == 20)
                       {?> <span class="badge badge-success">Tiler</span> <?php } 
                       elseif($listing->service_type == 21)
                       {?> <span class="badge badge-success">Welder</span> <?php } 
                       elseif($listing->service_type == 22)
                       {?> <span class="badge badge-success">Plumber</span> <?php } 
                       
                       elseif($listing->service_type == 23)
                       {?> <span class="badge badge-success">Carpenter</span> <?php } 
                       
                       elseif($listing->service_type == 24)
                       {?> <span class="badge badge-success">Laundry</span> <?php } 
                       
                       elseif($listing->service_type == 25)
                       {?> <span class="badge badge-success">Panel Beater</span> <?php } 
                       
                       elseif($listing->service_type == 26)
                       {?> <span class="badge badge-success">AC Installer</span> <?php } 
                       
                       elseif($listing->service_type == 27)
                       {?> <span class="badge badge-success">Pedicure and Manicure (Pedicurist)</span> <?php } 
                       
                       elseif($listing->service_type == 28)
                       {?> <span class="badge badge-success">Electrician</span> <?php } 
                       
                       elseif($listing->service_type == 29)
                       {?> <span class="badge badge-success">Fridge Repairer</span> <?php } 


                       elseif($listing->service_type == 30)
                       {?> <span class="badge badge-success">Aliminum door/window Installer</span> <?php } 
                       
                       elseif($listing->service_type == 31)
                       {?> <span class="badge badge-success">Safety and Fire Alarm System Installer</span> <?php }
                       
                       elseif($listing->service_type == 32)
                       {?> <span class="badge badge-success">Bricklayer</span> <?php }
                       elseif($listing->service_type == 33)
                       {?> <span class="badge badge-success">Dish Installer</span> <?php }
                       elseif($listing->service_type == 34)
                       {?> <span class="badge badge-success">fashion designer</span> <?php } 
                       
                       
                       elseif($listing->service_type == 37)
                       {?> <span class="">CCTV, SOLAR and INVERTER</span> <?php }  
                       
                       elseif($listing->service_type == 38)
                       {?> <span class="">Make-up Artist</span> <?php }  


                       elseif($listing->service_type == 39)
                       {?> <span class="">Gele Tie</span> <?php }  


                       elseif($listing->service_type == 40)
                       {?> <span class="">Television Repairer</span> <?php }  
                       

                       elseif($listing->service_type == 41)
                       {?> <span class="">Photographer and Videographer</span> <?php }  
                       

                       elseif($listing->service_type == 42)
                       {?> <span class="">Welder</span> <?php }  


                       elseif($listing->service_type == 43)
                       {?> <span class=""> Honda Car Mechanic</span> <?php }  



                       elseif($listing->service_type == 44)
                       {?> <span class="">  Toyota Mechanic</span> <?php }  




                       elseif($listing->service_type == 45)
                       {?> <span class="">  Ford Mechanic</span> <?php } 



                       elseif($listing->service_type == 46)
                       {?> <span class="">   Kia Mechanic</span> <?php } 
                       


                       elseif($listing->service_type == 47)
                       {?> <span class="">   Nissan Car Mechanic</span> <?php } 


                       elseif($listing->service_type == 49)
                       {?> <span class="">   Cake & Pastries Maker</span> <?php } 



                       elseif($listing->service_type == 50)
                       {?> <span class="">   Panel Beater</span> <?php } 



        
                       elseif($listing->service_type == 51)
                       {?> <span class="">    Auto Electrician</span> <?php } 


                       elseif($listing->service_type == 52)
                       {?> <span class="">    Japanese Car Mechanic</span> <?php } 


                       elseif($listing->service_type ==53)
                       {?> <span class="">     Shoe Cobbler</span> <?php } 
                       
                       elseif($listing->service_type ==54)
                       {?> <span class="">     Interior Decoration</span> <?php } 


                       elseif($val->service_type ==55)
                       {?> <span class="">     Fumigation and Pest Control</span> <?php } 


          
                       else{?> <span class="badge badge-danger">No Service Chosen</span> <?php } ?>
                </li>
                <!-- <li class="list-group-item d-flex justify-content-between">
                    <span>Status </span> <?php if($listing->status == 1){?> <span class="badge badge-success">Active</span> <?php }else{?> <span class="badge badge-danger">InActive</span> <?php } ?>
                </li> -->
                <li class="list-group-item d-flex justify-content-between">
                     <span>Is Verified</span> <?php if($listing->is_phone_verified == 1){?> <span class="badge badge-info"> Verified</span> 
                      <?php }else{?> <span class="badge badge-danger">Unverified</span> <?php }?>
                </li>



                <li class="list-group-item d-flex justify-content-between">
                    <span>Location </span> <span>{{ $listing->location }}</span>
                </li>


                <h6>Profile Image</h6>
                <img src="{{ url('storage/uploads/profile') . '/' . $listing->profile }}" width="200" height="200">
                </ul>
                </div>   
                  
                <div class="col-md-6">
              
                </div> 
                 
               
                     
                </div>
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
</script>
@stop