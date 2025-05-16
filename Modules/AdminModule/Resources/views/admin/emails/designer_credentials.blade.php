<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Marketing App – Designer Access</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background: #f9f9f9;
            padding: 30px;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .header {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .login-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #0d6efd;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
        }
        .info {
            margin: 20px 0;
        }
        .footer {
            font-size: 13px;
            color: #777;
            margin-top: 40px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">Welcome, {{ $user->name }}!</div>

    <p>We're excited to have you on board as a <strong>Designer</strong> in the Marketing App.</p>

    <div class="info">
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Password:</strong> {{ $password }}</p>
    </div>

    <p>Click the button below to log into your designer dashboard:</p>

    <a href="{{ url('/designer-login') }}" class="login-btn">Login Now</a>

    <div class="footer">
        If you have any issues, feel free to reach out to support.<br><br>
        — Marketing App Team
    </div>
</div>
</body>
</html>
