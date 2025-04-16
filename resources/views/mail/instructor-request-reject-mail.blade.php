<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Instructor Request Rejected</title>
  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
      color: #333;
    }
    .email-wrapper {
      max-width: 600px;
      margin: auto;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    .email-header {
      padding: 20px;
      background-color: #f44336;
      color: white;
      text-align: center;
    }
    .email-body {
      padding: 30px;
    }
    .email-body h2 {
      margin-top: 0;
      color: #f44336;
    }
    .email-body p {
      line-height: 1.6;
    }
    .email-footer {
      padding: 20px;
      font-size: 12px;
      color: #888;
      text-align: center;
      background-color: #f1f1f1;
    }
    .btn {
      display: inline-block;
      padding: 10px 20px;
      margin-top: 20px;
      background-color: #f44336;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
    }
    .btn:hover {
      background-color: #d32f2f;
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <div class="email-header">
      <h1>Instructor Access Request</h1>
    </div>
    <div class="email-body">
      <h2>We're Sorry!</h2>
      <p>Hello,</p>
      <p>
        After reviewing your request to become an instructor on <strong>Learning-Core</strong>, we regret to inform you that your request has been declined at this time.
      </p>
      <p>
        If you believe this was an error or you'd like to appeal or provide more information, feel free to contact our support team.
      </p>
      <a href="{{ url('/') }}" class="btn">Back to Home</a>
    </div>
    <div class="email-footer">
      &copy; {{ date('Y') }} Learning-Core. All rights reserved.
    </div>
  </div>
</body>
</html>
