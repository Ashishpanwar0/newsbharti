
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | NewsBharti</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
            background: #f3f5f9;
            font-family: Arial, sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 32px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
        }

        h1 { margin: 0 0 8px; font-size: 27px; }
        .subtitle { color: #667085; margin-bottom: 26px; }

        label {
            display: block;
            margin: 16px 0 8px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d0d5dd;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            width: 100%;
            margin-top: 22px;
            padding: 13px;
            border: 0;
            border-radius: 6px;
            background: #c8102e;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }

        .error {
            color: #b42318;
            font-size: 14px;
            margin-top: 8px;
        }

        .brand { color: #c8102e; font-weight: 800; }
    </style>
</head>
<body>
    <main class="login-card">
        <h1><span class="brand">News</span>Bharti</h1>
        <p class="subtitle">Sign in to the administration panel.</p>

        @if ($errors->any())
            <div class="error" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <label for="email">Email address</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                autocomplete="username"
                required
                autofocus
            >

            <label for="password">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                required
            >

            <button type="submit">Sign In</button>
        </form>
    </main>
</body>
</html>
