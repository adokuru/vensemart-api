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
                       {?> <span class="badge badge-success">Tailor</span> <?php }   
                       
          
                       else{?> <span class="">No Service Chosen</span> <?php }
                    ?></td>

<td> <?php if(!empty($val->profile)){?>
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
                    <a href="{{url('admin/exist_serviceprovider/viewserviceprovider').'/'.$val->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a> |
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