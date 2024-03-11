<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">ecommerce</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/')}}">
              <i class="bi bi-house"></i> Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu">
              @foreach ($categories as $c)
              <li><a class="dropdown-item" href="{{url('/collection/'.$c->name)}}">{{$c->name}}</a></li>
              <li><hr class="dropdown-divider"></li>
              @endforeach         
         
            </ul>
        </li>
        </ul>
        <form class="d-flex" role="search" action="{{url('search')}}">
          <div class="input-group">
          <input class="form-control" name="search" type="text" value="{{Request::get('search')}}" placeholder="Search" aria-label="Search">
          <button class="btn btn-danger" type="submit"><i class="bi bi-search"></i></button>
          </div>
        </form>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{url('/cart')}}">
              <i class="bi bi-cart" style="font-size: 25px">
              </i><span class="badge rounded-pill text-bg-danger"  
              style="position:relative;top:-10px;left:-5px"> 
                  <livewire:frontend.cart.cart-count/>
                </span></a>
          </li>

            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                          <i class="bi bi-lock"></i> {{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                          <i class="bi bi-pen"></i> {{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                   <a class="dropdown-item" href="{{ url('profile') }}">
                     <i class="bi bi-person-fill"></i> Profile
                   </a>  <hr/>
                   <a class="dropdown-item" href="{{ url('cart') }}">
                    <i class="bi bi-cart"></i> My Cart
                  </a>  <hr/>
                  <a class="dropdown-item" href="{{ url('myorders') }}">
                    <i class="bi bi-list"></i> My Orders
                  </a>  <hr/>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <i class="bi bi-arrow-left"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
              
                    </div>
                </li>
            @endguest
        </ul>
      </div>
    </div>
  </nav>

