<h1>Apologies, but you currently lack the necessary access.</h1>

@if(session('access_token.access_token'))
<!-- User is authenticated -->
<form action="{{ url('/logout') }}" method="POST" class="logout-btn">
    @csrf
    <button type="submit">Logout</button>
</form>
@else
<!-- User is not authenticated -->
<a href="https://otms.herpower.gov.bd/">Login</a>
@endif