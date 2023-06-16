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
            <h3 class="card-title">New Service Provider Listing</h3>
             <div class=" ml-auto w-75 text-right ">
                <a href="{{url('admin/new-driver/add')}}" class="btn btn-primary btn-sm px-4"> Add </a>
             </div>
          </div>
          <!-- card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>S.No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>mobile</th>
                <th>Service</th>
                <th>ID Proof</th>   
                 <th>Verify</th>
                <th>Is Verified</th> 
               <th>Registered</th>
                <!-- <th>ID Proof</th>  -->
                <!-- <th>Is Verify</th> -->
             
                <!-- <th>Status</th> -->
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php if($listing){ $i=1; foreach($listing as $val){?>      
              <tr>
                <td>{{  $i }}</td>
                <td>{{ $val->name }}</td>
                <td>{{ $val->email }}</td>
                <td>{{ $val->mobile }}</td>
                <td><?php if($val->service_type == 1)
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
                       {?> <span class="">fashion designer</span> <?php }  
                       
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

                       elseif($val->service_type ==54)
                       {?> <span class="">     Interior Decoration</span> <?php } 


                       elseif($val->service_type ==55)
                       {?> <span class="">     Fumigation and Pest Control</span> <?php } 


                       
          
                       else{?> <span class="">No Service Chosen</span> <?php }
                    ?></td> 
                

                <td><?php if(!empty($val->profile)){?>
                                                <img src="{{ url('storage/uploads/profile') . '/' . $val->profile }}" width="50" height="50">
                                                <?php } 
                    else
                    {
                        ?>
                                                <img src="{{ url('uploads/profile') }}/noimageavailable.jpg" width="50" height="50">
                                                <?php
                    }
                    ?>
                                            </td>
                <td>
               
               <select onchange="change_status(<?php echo $val->id;?>,this)">
                   <option value="0" <?php if($val->is_phone_verified == 0){ echo "Selected";}?> > <a href="#heading1">Unverify </a></option>
                   <option value="1" <?php if($val->is_phone_verified == 1){ echo "Selected";}?> >  <a href="#heading1">Verify </a></option>
                  
               </select>
               </td>

                <td>
                    <?php if($val->is_phone_verified == 1){ ?>
                      <span class="badge badge-success">Verified</span>
                <?php }else { ?>
                      <span class="badge badge-danger">Not Verified</span>
               <?php  } ?>
               </td>


               <td>  {{ \Carbon\Carbon::parse($val->created_at)->diffForHumans() }}</td>
               

               
                <td>
                    <a href="{{url('admin/new_serviceprovider/viewserviceprovider_new/').'/'.$val->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a> |
                    <!--<a href="{{url('admin/new-driver/edit').'/'.$val->id }}"><i class="fas fa-edit"></i></a> |-->
                    <a href="{{url('admin/exist_serviceprovider/existingserviceprovider_delete').'/'.$val->id }}"><i class="fas fa-trash"></i></a>
                </td>
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
        var is_phone_verified  =a.value;
     
          $.ajax({

            type: "GET",

            dataType: "json",

            url: '{{ url('admin/new_serviceprovider/change_status_of_serviceprovider') }}',

            data: {'is_vaify_val': is_phone_verified, 's_id': d_id},

            success: function(data){
                //console.log(data);
            location.reload();
            }

        });
    }

</script>
@stop