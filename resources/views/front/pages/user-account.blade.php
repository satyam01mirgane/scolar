@include('front.common.profile-header')
@include('front.common.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: #f4f6f9; min-height: 100vh; padding: 20px;">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-bottom: 20px;">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="font-size: 2.5rem; color: #333; font-weight: 600;">User Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" style="background: none; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{url('/')}}" style="color: #007bff; text-decoration: none;">Home</a></li>
                        <li class="breadcrumb-item active" style="color: #6c757d;">User Profile</li>
                    </ol>
                </div>
            </div>
        </div>
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
                    <div class="card card-primary card-outline" style="border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1); overflow: hidden; transition: all 0.3s ease;">
                        <div class="card-body box-profile" style="padding: 30px;">
                            <div class="text-center" style="margin-bottom: 20px;">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{$photo}}"
                                     alt="User profile picture"
                                     style="width: 150px; height: 150px; object-fit: cover; border: 5px solid #fff; box-shadow: 0 0 20px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                            </div>

                            <h3 class="profile-username text-center" style="font-size: 1.5rem; color: #333; margin-bottom: 10px;">{{Auth::user()->name}}</h3>
                            <div class="text-center text-sm text-primary" style="font-size: 0.9rem;">Member Since {{date('d M Y',strtotime(Auth::user()->created_at))}}</div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card" style="border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1); overflow: hidden; transition: all 0.3s ease;">
                        <div class="card-body p-0">
                            <table class="table" style="margin-bottom: 0;">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="border-top: none;">
                                            <a href="{{url('profile-edit')}}" class="badge bg-danger" style="float: right; padding: 10px 15px; font-size: 0.9rem; text-decoration: none; background-color: #dc3545; color: #fff; border-radius: 5px; transition: all 0.3s ease;">Edit Profile</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%; padding: 20px; font-size: 1rem; color: #333;">Personal ID</th>
                                        <td style="padding: 20px; font-size: 1rem; color: #666;">User{{Auth::user()->unique_id}}</td>
                                    </tr>
                                    <!-- Add other rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('front.common.profile-footer')

<script>
    // Toggle the sidebar on/off
    function toggleSidebar() {
        const sidebar = document.querySelector('.main-sidebar');
        sidebar.classList.toggle('sidebar-collapse');
    }
</script>
