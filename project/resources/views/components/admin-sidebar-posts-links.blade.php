

<!-- Management_sidebar -->
@if(auth()->user()->userHasRole('Manager'))
<li class="nav-item">
  <a  href="{{route('admin.index')}}" data-toggle="collapse" data-target="#collapseone" aria-expanded="true" aria-controls="collapseone">
   

   <a class="nav-link collapsed" href="{{route('employee.view_employee')}}" style="color: white;"> <i class="fas fa-user-friends"></i><span>Employee</span></a> 
   <a class="nav-link collapsed" href="{{route('company_vehicle.store')}}" style="color: white;"> <i class="fas fa-user-friends"></i><span>Company Vehicle</span></a> 
   
    
    
    
  </a>
  <!-- <div id="collapseone" class="collapse" aria-labelledby="headingone" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Management:</h6>
      
      <a class="collapse-item" href="">Create Employee guest</a>
      <a class="collapse-item" href="">Create Management guest</a>
      <a class="collapse-item" href="">Create Special guest</a>
     
    </div>
  </div> -->
</li>

@endif

<!--Admin sidebar-->
@if(auth()->user()->userHasRole('Admin'))

<li class="nav-item">

  <a class="nav-link collapsed" href="{{route('admin.index')}}" data-toggle="collapse" data-target="#collapsedata" aria-expanded="true" aria-controls="collapseone">
  <i class="fas fa-user-cog"></i>
    <span>Admin</span>
  </a>
  <div id="collapsedata" class="collapse" aria-labelledby="headingdata" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Admin:</h6>
      <!-- @if(auth()->user()->userHasRole('Admin')) -->
      <!-- <a class="collapse-item" href="{{route('admin.index')}}">Dashboard</a> -->
      <a class="collapse-item" href="{{route('admin.reports')}}">Guest Reports</a>
      <a class="collapse-item" href="{{route('contractual_worker.report')}}">Worker Reports</a>
      <a class="collapse-item" href="{{route('admin.attendance_reports')}}">Employee Reports</a>
      <a class="collapse-item" href="{{route('admin.vehicle_reports')}}">Vehicle Reports</a>
      <!-- @endif -->
    </div>
  </div>
  <a class="nav-link collapsed" href="{{route('employee.index')}}" style="color: white;"> <i class="fas fa-user-friends"></i><span>Employee</span></a> 
  <a class="nav-link collapsed" href="{{route('user_role_manage')}}" style="color: white;"> <i class="fas fa-user-friends"></i><span>Role Management</span></a> 
  
</li>
@endif



@if(auth()->user()->userHasRole('SuperAdmin'))

<li class="nav-item">

  <a class="nav-link collapsed" href="{{route('admin.index')}}" data-toggle="collapse" data-target="#collapsedata" aria-expanded="true" aria-controls="collapseone">
  <i class="fas fa-user-cog"></i>
    <span>Attendance Manager</span>
  </a>
  <div id="collapsedata" class="collapse" aria-labelledby="headingdata" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Attendance:</h6>
 
      <a class="collapse-item" href="{{route('attendance.truncate_form')}}">Clear Attendance</a>
      <a class="collapse-item" href="{{route('attendance.form')}}">Export Attendance Sheet</a>

      

    </div>
   
  </div>
  <!-- <a class="nav-link collapsed" href="http://localhost/finger/zktest.php/" style="color: white;"> <i class="fas fa-user-check"></i><span>Clear Data</span></a>
  -->
</li>
@endif




