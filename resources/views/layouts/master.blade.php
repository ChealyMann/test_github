@include('layouts.header');
@include('layouts.sidebar');

  {{--dynamic pages--}}
  @yield('content')

@include('layouts.footer')

