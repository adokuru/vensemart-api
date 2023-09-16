@extends('app')

@section('content')
 <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Existing User Listing Referrals</h3>
                <div class=" ml-auto w-75 text-right "></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <!-- <th>Email</th> -->
                    <th>Mobile</th>
                    <th>Referred By</th>
                    <th>Number of Users Referred</th>
                    <th>Names of Users Referred</th>
                    <th>Image</th>
                    <!-- <th>Status</th> -->
                    <th>Registered</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if($users)
                    @foreach($users as $i => $user)
                      <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <!-- <td>{{ $user->email }}</td> -->
                        <td>{{ $user->mobile }}</td>
                        <td>{{ $user->referredBy ? $user->referredBy->name : 'N/A' }}</td>
                        <td>{{ $user->referrals->count() }}</td>
                        <td>
                          @if($user->referrals->count() > 0)
                            @foreach($user->referrals as $referredUser)
                              {{ $referredUser->name }},
                            @endforeach
                          @else
                            No User
                          @endif
                        </td>

                        <td>
                          @if($user->profile)
                            <img src="{{ url('storage/uploads/profile').'/'.$user->profile }}" width="50" height="50">
                          @else
                            <img src="{{ url('uploads/profile') }}/noimageavailable.jpg" width="50" height="50">
                          @endif
                        </td>
                        <!-- <td>
                          @if($user->status == 1)
                            <span class="badge badge-success">Active</span>
                          @else
                            <span class="badge badge-danger">InActive</span>
                          @endif
                        </td> -->
                        <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                        <td>
                          <a href="{{ url('admin/existinguser/delete').'/'.$user->id }}"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
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
    // DataTable initialization code here
  });
  
  $(document).ready(function(){
     // Your existing JavaScript code here
  });
</script>
@stop
