<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Congratulations - Instructor Access</title>
    <style>
        body {
            background-color: #edf2f7;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #2d3748;
        }
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #edf2f7;
            padding: 20px 0;
        }
        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 570px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .header {
            background-color: #2d3748;
            padding: 20px;
            text-align: center;
            color: #ffffff;
            font-size: 20px;
            font-weight: bold;
        }
        .content {
            padding: 30px;
        }
        .content h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #a0aec0;
            padding: 20px;
        }
        .button {
            display: inline-block;
            background-color: #2d3748;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 4px;
            margin-top: 20px;
        }
        @media only screen and (max-width: 600px) {
            .main {
                width: 100% !important;
            }
        }
    </style>
</head>
<body>
    <table class="wrapper" role="presentation">
        <tr>
            <td>
                <table class="main" role="presentation" align="center">
                    <tr>
                        <td class="header">
                            🎉 Instructor Access Approved
                        </td>
                    </tr>
                    <tr>
                        <td class="content">
                            <h1>Congratulations!</h1>
                            <p>
                                Your request to become an instructor has been approved. You now have full access to instructor features including creating courses, managing content, and engaging with students.
                            </p>
                            <p>
                                We're excited to see what you’ll share with our community.
                            </p>
                            <p>
                                You can get started now by accessing your instructor dashboard.
                            </p>
                            <a href="{{ url('https://learning-core.test/instructor/dashboard') }}" class="button">Go to Dashboard</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="footer">
                            &copy; {{ date('Y') }} Learning-Core. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
