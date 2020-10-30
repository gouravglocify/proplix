<nav id="sidebar" class="img" style="background-image: url({{asset('/images/bg-3.webp')}});background-size: cover;">
	<div class="p-4">
		<div class="avatar">
  		<img src="{{asset('images/logo1.png')}}" width="42" height="42">
      <span class="logo-text">
          ProPlix 
      </span>
  		<a href="{{url('adminProfile')}}" class="profile"><h4>{{ucwords(strtolower($userDetails->name))}}</h4></a>
  		<p>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
      </p>
  	</div>
    <ul class="list-unstyled components mb-5">
      <li>
          <a href="{{url('adminDashboard')}}"><span class="fa fa-calculator mr-3"></span>Dashboard</a>
      </li>
      <li>
          <a href="{{url('adminProfile')}}"><span class="fa fa-user mr-3"></span>My Profile</a>
      </li>
      <li>
        <a href="{{url('reports')}}"><span class="fa fa-database mr-3"></span>Reports</a>
      </li>
      <li>
        <a href="{{url('users')}}"><span class="fa fa-users mr-3"></span>Users</a>
      </li>
      <li>
        <a href="{{url('coupons')}}"><span class="fa fa-sticky-note mr-3"></span>Coupons</a>
      </li>
      <li>
        <a href="{{url('usersMembership')}}"><span class="fa fa-product-hunt mr-3"></span>User's Meberships</a>
      </li>
      <li>
        <a href="{{ route('logout') }}"onclick="event.preventDefault();
           document.getElementById('logout-form').submit();"><span class="fa fa-sign-out mr-3"></span>Logout</a>
      </li>
    </ul>
  </div>
</nav>