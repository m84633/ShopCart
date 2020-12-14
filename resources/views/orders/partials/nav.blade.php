<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark bg-primary">
<div class="container">
    <a class="navbar-brand" href="#"><strong>Orders</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
      aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <form class="form-inline">
{{--       <div class="md-form my-0">
        <input class="form-control mr-sm-2" type="text" placeholder="搜尋訂單" aria-label="Search">
      </div> --}}
  </form>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
      <ul class="navbar-nav ml-auto">
{{--         <li class="nav-item active">
          <a class="nav-link" href="#">
            <i class="fab fa-facebook-f"></i> Facebook
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fab fa-instagram"></i> Instagram</a>
        </li> --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i></a>
          <div  class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
            <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item" href="#">登出</a>
          </div>
          <form id="logout-form" method="post" action="{{ route('logout') }}" style="display: none">
            @csrf
          </form>
        </li>
      </ul>
    </div>
  <!--/.Navbar -->
</div>
  </nav>
