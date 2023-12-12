<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Token Retrieval Form</title>
</head>

<body>

    <h2>Token Retrieval Form</h2>

    @if(session('token'))
    <div style="color: green;">
        Token: {{ session('token') }}
    </div>
    @endif

    @if(session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div style="color: red;">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ url('/get-token') }}" method="post">
        @csrf

        <label for="email">Email:</label>
        <input type="text" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Get Token</button>
    </form>

</body>

</html>