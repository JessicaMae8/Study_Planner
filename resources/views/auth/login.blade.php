
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Study Planner</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: linear-gradient(135deg, #f4efff, #e8e2ff);
            color: #292344;
        }

        .login-container {
            width: 100%;
            max-width: 960px;
            min-height: 560px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(75, 52, 130, 0.15);
        }

        .welcome-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 48px;
            background: linear-gradient(145deg, #7654d6, #5638ad);
            color: #fff;
        }

        .brand {
            font-size: 17px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 48px;
        }

        .book-icon {
            font-size: 58px;
            margin-bottom: 22px;
        }

        .welcome-panel h1 {
            font-size: 35px;
            line-height: 1.2;
            margin-bottom: 18px;
        }

        .welcome-panel p {
            color: #eee8ff;
            font-size: 15px;
            line-height: 1.8;
        }

        .login-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 48px;
        }

        .login-panel h2 {
            font-size: 29px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #858098;
            font-size: 14px;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        input {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #ddd7ed;
            border-radius: 10px;
            background: #fcfbff;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            border-color: #7654d6;
            box-shadow: 0 0 0 3px rgba(118, 84, 214, 0.12);
        }

        .error-box {
            margin-bottom: 22px;
            padding: 13px 16px;
            border: 1px solid #fecaca;
            border-radius: 10px;
            background: #fff1f2;
            color: #b42332;
            font-size: 13px;
        }

        .error-box ul {
            padding-left: 20px;
            margin-top: 7px;
        }

        .login-button {
            width: 100%;
            padding: 14px;
            margin-top: 8px;
            border: none;
            border-radius: 10px;
            background: #6d4bc3;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .login-button:hover {
            background: #5638ad;
            transform: translateY(-1px);
        }

        .footer-text {
            margin-top: 26px;
            color: #938da5;
            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 700px) {
            body {
                padding: 16px;
            }

            .login-container {
                grid-template-columns: 1fr;
            }

            .welcome-panel {
                padding: 30px;
            }

            .brand {
                margin-bottom: 24px;
            }

            .book-icon {
                font-size: 42px;
                margin-bottom: 12px;
            }

            .welcome-panel h1 {
                font-size: 28px;
            }

            .login-panel {
                padding: 32px 26px;
            }
        }
    </style>
</head>
<body>

    <main class="login-container">
        <section class="welcome-panel">
            <div class="brand">✦ STUDY PLANNER</div>

            <div class="book-icon">📚</div>

            <h1>Make every study session count.</h1>

            <p>
                Stay organized, manage your study tasks, and keep
                moving toward your academic goals.
            </p>
        </section>

        <section class="login-panel">
            <h2>Welcome back!</h2>

            <p class="subtitle">
                Sign in to continue to your Study Planner account.
            </p>

            @if ($errors->any())
                <div class="error-box">
                    <strong>Login failed.</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        autocomplete="email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <button type="submit" class="login-button">
                    Log In
                </button>
            </form>

            <p class="footer-text">
                Study Planner · Organize your learning, one day at a time.
            </p>
        </section>
    </main>

</body>
</html>
