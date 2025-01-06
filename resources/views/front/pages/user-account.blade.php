@include('front.common.sidebar')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            @php
            if(isset(Auth::user()->photo))
            {
                $photo = asset('profile/'.Auth::user()->photo);
            }else{
                $photo = asset('user.png');
            }
            @endphp
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{$photo}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
                <div class="text-center text-sm text-primary">Member Since {{date('d M Y',strtotime(Auth::user()->created_at))}}</div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-9">
            <div class="card">
              <div class="card-body p-0">
                @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                      <p class="text-green-800">{{ $message }}</p>
                  </div>
                @endif
                <table class="table">
                  <td><a href="{{url('profile-edit')}}" class="badge bg-danger">Edit</a>
                  <tbody>
                    <tr>
                      <th>Personal ID</th>
                      <td>User{{Auth::user()->unique_id}}</td>
                    </tr>
                    <tr>
                      <th>Name</th>
                      <td>{{Auth::user()->name}}</td>
                    </tr>
                    <tr>
                      <th>Email Address</th>
                      <td>{{Auth::user()->email}}</td>
                    </tr>
                    <tr>
                      <th>Contact Number</th>
                      <td>{{Auth::user()->phone_number}}</td>
                    </tr>
                    <tr>
                      <th>Password</th>
                      <td>**************</td>
                    </tr>
                    <tr>
                      <th>Address</th>
                      <td>{{Auth::user()->address}}</td>
                    </tr>
                    <tr>
                      <th>Pincode</th>
                      <td>{{Auth::user()->pincode}}</td>
                    </tr>
                    <tr>
                      <th>Date of Birth</th>
                      <td>{{date('d-M-Y',strtotime(Auth::user()->dob))}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>
@include('front.common.profile-footer')
