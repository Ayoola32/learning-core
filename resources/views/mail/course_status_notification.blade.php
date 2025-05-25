<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Course Status Update</title>
    <style type="text/css">
        /* Reset styles for email clients */
        body, table, td, p, a, div {
            margin: 0;
            padding: 0;
        }

        body {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
        }

        img {
            border: 0;
            max-width: 100%;
            height: auto;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Container styles */
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
        }

        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 15px;
            text-align: center;
        }

        .content {
            padding: 20px;
            color: #333333;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #666666;
        }

        /* Specific elements */
        .status-approved {
            background-color: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
        }

        .feedback-quote {
            background-color: #f1f1f1;
            padding: 10px;
            border-left: 4px solid #007bff;
            margin: 10px 0;
        }

        .panel {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <table class="email-container" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td>
                <div class="header">
                    <h1>Course Status Update</h1>
                </div>
                <div class="content">
                    <p>Hi {{ $course->instructor->first_name ?? 'Instructor' }},</p>
                    <p>We have reviewed your course <strong>{{ $course->title }}</strong>, and we are
                        @if ($status === 'approved')
                            <span class="status-approved">pleased to inform you that it has been approved.</span>
                        @else
                            <span class="status-rejected">sorry to inform you that your request has been rejected this time.</span> 
                        @endif
                    </p>

                    <div class="feedback-quote">
                        <p><strong>Feedback:</strong></p>
                        <p>{{ $feedback }}</p>
                    </div>

                    <div class="panel">
                        @if ($status === 'approved')
                            <p>Your course is now live (or will be live shortly, depending on additional processing).
                                You can view it on the platform or make further edits if needed.</p>
                        @else
                            <p>Please review the feedback above, make the necessary revisions, and resubmit your course
                                for approval. If you have any questions, feel free to reach out to the support team.</p>
                        @endif
                    </div>

                    <p>Thank you for your submission!</p>
                </div>
                <div class="footer">
                    <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
