<h1>Apologies, but you currently lack the necessary access.</h1>

@if(Auth::check())
<!-- User is authenticated -->
<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>
@else
<!-- User is not authenticated -->
<a href="{{ route('login') }}">Login</a>
@endif