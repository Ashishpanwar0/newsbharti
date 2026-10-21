<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#172033">
    <title>Admin Login | Samachar Bharti</title>

    <style>
        :root {
            --sb-red: #ed101b;
            --sb-blue: #1239c5;
            --sb-navy: #172033;
            --sb-muted: #687386;
            --sb-border: #e4e8f0;
            --sb-bg: #f4f6fb;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 28px 18px;
            display: grid;
            place-items: center;
            color: var(--sb-navy);
            background:
                radial-gradient(circle at 12% 12%, rgba(18, 57, 197, .08), transparent 30%),
                radial-gradient(circle at 88% 88%, rgba(237, 16, 27, .07), transparent 28%),
                var(--sb-bg);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .login-shell {
            width: 100%;
            max-width: 440px;
        }

        .login-card {
            overflow: hidden;
            padding: 38px;
            background: #fff;
            border: 1px solid rgba(228, 232, 240, .95);
            border-radius: 22px;
            box-shadow: 0 24px 70px rgba(23, 32, 51, .11);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 34px;
            color: var(--sb-navy);
            text-decoration: none;
        }

        .brand-mark {
            display: grid;
            width: 46px;
            height: 46px;
            place-items: center;
            border-radius: 14px;
            color: #fff;
            background: var(--sb-red);
            font-size: 19px;
            font-weight: 850;
            letter-spacing: -1px;
            box-shadow: 0 7px 16px rgba(237, 16, 27, .2);
        }

        .brand-name {
            font-size: 22px;
            font-weight: 850;
            line-height: 1.1;
            letter-spacing: -.7px;
        }

        .brand-name span { color: var(--sb-blue); }

        .eyebrow {
            margin: 0 0 10px;
            color: var(--sb-red);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-size: clamp(27px, 5vw, 32px);
            font-weight: 800;
            letter-spacing: -1.1px;
        }

        .intro {
            margin: 10px 0 28px;
            color: var(--sb-muted);
            font-size: 14px;
            line-height: 1.65;
        }

        .field { margin-bottom: 20px; }

        .field-label {
            display: block;
            margin-bottom: 8px;
            color: #293449;
            font-size: 13px;
            font-weight: 700;
        }

        .field-input {
            display: block;
            width: 100%;
            min-height: 49px;
            padding: 12px 14px;
            border: 1px solid #dce2ec;
            border-radius: 11px;
            outline: none;
            color: var(--sb-navy);
            background: #fff;
            font: inherit;
            font-size: 14px;
            transition: border-color .18s ease, box-shadow .18s ease;
        }

        .field-input::placeholder { color: #a0a8b6; }

        .field-input:focus {
            border-color: var(--sb-blue);
            box-shadow: 0 0 0 4px rgba(18, 57, 197, .1);
        }

        .password-wrap { position: relative; }
        .password-wrap .field-input { padding-right: 76px; }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            padding: 5px 2px;
            transform: translateY(-50%);
            border: 0;
            color: var(--sb-blue);
            background: transparent;
            font: inherit;
            font-size: 12px;
            font-weight: 750;
            cursor: pointer;
        }

        .toggle-password:focus-visible {
            outline: 2px solid var(--sb-blue);
            outline-offset: 3px;
            border-radius: 3px;
        }

        .error-box {
            margin: 0 0 20px;
            padding: 12px 14px;
            border: 1px solid #fecaca;
            border-radius: 10px;
            color: #991b1b;
            background: #fff1f2;
            font-size: 13px;
            line-height: 1.5;
        }

        .submit-btn {
            display: flex;
            width: 100%;
            min-height: 50px;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 7px;
            border: 0;
            border-radius: 11px;
            color: #fff;
            background: var(--sb-blue);
            box-shadow: 0 8px 18px rgba(18, 57, 197, .19);
            font: inherit;
            font-size: 14px;
            font-weight: 750;
            cursor: pointer;
            transition: transform .18s ease, background .18s ease, box-shadow .18s ease;
        }

        .submit-btn:hover {
            transform: translateY(-1px);
            background: #0d2eaa;
            box-shadow: 0 11px 22px rgba(18, 57, 197, .24);
        }

        .submit-btn:focus-visible {
            outline: 3px solid rgba(18, 57, 197, .3);
            outline-offset: 3px;
        }

        .submit-btn svg { width: 17px; height: 17px; }

        .secure-note {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 7px;
            margin: 22px 0 0;
            color: #7b8494;
            font-size: 11px;
        }

        .secure-note svg { width: 14px; height: 14px; }

        .page-footer {
            margin: 19px 0 0;
            color: #8a93a2;
            font-size: 11px;
            text-align: center;
        }

        @media (max-width: 480px) {
            body { padding: 18px 12px; }
            .login-card { padding: 28px 23px; border-radius: 18px; }
            .brand { margin-bottom: 29px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition: none !important; }
        }
    </style>
</head>
<body>
    <main class="login-shell">
        <section class="login-card" aria-labelledby="login-heading">
            <a class="brand" href="{{ url('/') }}" aria-label="Samachar Bharti home">
                <span class="brand-mark" aria-hidden="true">SB</span>
                <span class="brand-name">Samachar <span>Bharti</span></span>
            </a>

            <p class="eyebrow">Administrator access</p>
            <h1 id="login-heading">Welcome back</h1>
            <p class="intro">Sign in to manage articles, categories, and your news portal.</p>

            @if ($errors->any())
                <div class="error-box" role="alert" aria-live="polite">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.store') }}">
                @csrf

                <div class="field">
                    <label class="field-label" for="email">Email address</label>
                    <input
                        class="field-input"
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        placeholder="admin@example.com"
                        autocomplete="username"
                        inputmode="email"
                        required
                        autofocus
                    >
                </div>

                <div class="field">
                    <label class="field-label" for="password">Password</label>
                    <div class="password-wrap">
                        <input
                            class="field-input"
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >
                        <button
                            class="toggle-password"
                            type="button"
                            id="togglePassword"
                            aria-controls="password"
                            aria-pressed="false"
                        >Show</button>
                    </div>
                </div>

                <button class="submit-btn" type="submit">
                    Sign in to dashboard
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </form>

            <p class="secure-note">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <rect x="5" y="10" width="14" height="11" rx="2" stroke="currentColor" stroke-width="1.7"/>
                    <path d="M8 10V7a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                    <circle cx="12" cy="15" r="1.2" fill="currentColor"/>
                </svg>
                Secure administrator sign-in
            </p>
        </section>

        <p class="page-footer">&copy; {{ date('Y') }} Samachar Bharti. All rights reserved.</p>
    </main>

    <script>
        (() => {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('togglePassword');

            if (!passwordInput || !toggleButton) return;

            toggleButton.addEventListener('click', () => {
                const shouldShow = passwordInput.type === 'password';
                passwordInput.type = shouldShow ? 'text' : 'password';
                toggleButton.textContent = shouldShow ? 'Hide' : 'Show';
                toggleButton.setAttribute('aria-pressed', String(shouldShow));
            });
        })();
    </script>
</body>
</html>
