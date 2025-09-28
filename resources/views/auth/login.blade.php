<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HealthMonitor</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 1rem;
        }
        .google-btn {
            background: #4285f4;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s;
        }
        .google-btn:hover {
            background: #357ae8;
        }
        .description {
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">🏥 HealthMonitor</div>
        <p class="description">
            Sistem monitoring tekanan darah yang mudah digunakan. 
            Login dengan akun Google Anda untuk memulai.
        </p>
        
        <a href="{{ route('auth.google') }}" class="google-btn">
            🔐 Login dengan Google
        </a>
        
        @if(session('error'))
            <div style="color: red; margin-top: 1rem;">
                {{ session('error') }}
            </div>
        @endif
    </div>
</body>
</html>