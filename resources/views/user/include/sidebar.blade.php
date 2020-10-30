<nav id="sidebar" class="img" style="background-image: url({{asset('/images/bg-3.webp')}});background-size: cover;">
	<div class="p-4 __LeftBar">
		<div class="avatar AvatarHead">
  		<img src="{{asset('images/logo1.png')}}" width="42" height="42">
      <span class="logo-text">
          ProPlix
      </span>
      <div class="UserName">
    		<a href="{{url('dashboard')}}" class="profile"><h4>{{isset($userDetails) && ($userDetails->name) ? ucwords(strtolower($userDetails->name)): ' '}}</h4></a>
        @if(isset($getUserSubscription) && (is_null($getUserSubscription)))
          @if (isset($getCaluationshit) && (is_null($getCaluationshit)))
            <p id="calculations"> Free (20 Calculations Left)</p>
          @else
            <p id="calculations"> Free ({{20 - count($getCaluationshit)}} Calculations Left)</p>
          @endif
        @else
          <p>PRO ( Unlimited Calculations )</p>
        @endif
    		<p>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
          </form>
        </p>
      </div>
  	</div>

    <span class="ShowButton"><i aria-hidden="true" class="fa fa-bars"></i></span>
    <ul class="list-unstyled components mb-5 LeftSideBar">
      <li>
          <a href="{{url('dashboard')}}"><span class="fa fa-tachometer mr-3"></span>Dashboard</a>
      </li>
      <li>
          <a href="{{url('profile')}}"><span class="fa fa-user mr-3"></span>My Profile</a>
      </li>
      <li>
          <a href="{{url('calculator')}}"><span class="fa fa-calculator mr-3"></span>Calculator</a>
      </li>
      <li>
        <a href="{{url('allReports')}}"><span class="fa fa-database mr-3"></span>Reports</a>
      </li>
      <li>
        <a href="{{url('packages')}}"><span class="fa fa-cogs mr-3"></span>Packages</a>
      </li>
       <li>
        <a href="{{url('support')}}"><span class="fa fa-phone mr-3"></span>Support</a>
      </li>
      <li>
        <a href="{{ route('logout') }}"onclick="event.preventDefault();
           document.getElementById('logout-form').submit();"><span class="fa fa-sign-out mr-3"></span>Logout</a>
      </li>
    </ul>
  </div>
</nav>


<script type="text/javascript">
  $('.ShowButton').click(function(){
    if ($(this).hasClass('FixeSideBar') ) {
    $(this).removeClass('FixeSideBar');
    }
    else{
    $('classname.FixeSideBar').removeClass('FixeSideBar')
    $(this).addClass('FixeSideBar');
  }
  });

</script>
