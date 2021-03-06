<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="{{ Auth::check() ? route('statuses_path') : route('home') }}" class="navbar-brand">Larabook</a>
    </div>

    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        <li class="">{{ link_to_route('users_path', 'Browse Users') }}</li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        @if ($currentUser)
          <li class="dropdown">


            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img class="nav-gravatar" src="{{ $currentUser->present()->gravatar }}" alt="{{ $currentUser->username }}">
              {{ $currentUser->username }} <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li>{{ link_to_route('profile_path', 'Your Profile', $currentUser->username) }}</li>
              <li class="divider"></li>
              <li>{{ link_to_route('logout_path', 'Log Out') }}</li>
            </ul>
          </li>
        @else
          <li>{{ link_to_route('register_path', 'Register') }}</li>
          <li>{{ link_to_route('login_path', 'Log In') }}</li>
        @endif
      </ul>
    </div>
  </div>
</nav>