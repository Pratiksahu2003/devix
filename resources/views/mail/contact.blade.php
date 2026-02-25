<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Enquiry | {{ config('company.short_name') }}</title>
    <style>
        /* Base Reset */
        body { margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f3f4f6; color: #1f2937; line-height: 1.6; }
        table { border-collapse: collapse; width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        
        /* Layout */
        .wrapper { width: 100%; background-color: #f3f4f6; padding: 40px 0; }
        .container { border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); }
        
        /* Header */
        .header { background-color: #000000; padding: 30px 40px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; letter-spacing: 1px; font-weight: 700; text-transform: uppercase; }
        .header-subtitle { color: #9ca3af; font-size: 12px; margin-top: 5px; letter-spacing: 2px; text-transform: uppercase; }

        /* Content */
        .content { padding: 40px; }
        .intro { font-size: 16px; color: #374151; margin-bottom: 25px; }
        
        /* Data Grid */
        .data-table { width: 100%; margin-bottom: 30px; border: 1px solid #e5e7eb; border-radius: 6px; overflow: hidden; }
        .data-row td { padding: 12px 15px; border-bottom: 1px solid #e5e7eb; }
        .data-row:last-child td { border-bottom: none; }
        .label { width: 120px; font-weight: 600; color: #6b7280; font-size: 13px; text-transform: uppercase; background-color: #f9fafb; }
        .value { color: #111827; font-weight: 500; font-size: 15px; }

        /* Message Box */
        .message-box { background-color: #f9fafb; border-left: 4px solid #004aad; padding: 20px; border-radius: 4px; margin-top: 10px; }
        .message-label { font-size: 12px; font-weight: 700; color: #6b7280; text-transform: uppercase; margin-bottom: 8px; display: block; }
        .message-text { color: #1f2937; white-space: pre-wrap; margin: 0; font-size: 15px; }

        /* Footer */
        .footer { background-color: #f9fafb; padding: 30px 40px; text-align: center; border-top: 1px solid #e5e7eb; }
        .footer-text { font-size: 12px; color: #9ca3af; margin-bottom: 5px; }
        .footer-link { color: #004aad; text-decoration: none; font-weight: 600; }
        
        /* Mobile */
        @media only screen and (max-width: 600px) {
            .wrapper { padding: 0; }
            .container { border-radius: 0; width: 100%; }
            .content { padding: 25px; }
            .header { padding: 25px; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <table class="container" role="presentation">
            <!-- Header -->
            <tr>
                <td class="header">
                    <h1>{{ config('company.short_name') }}</h1>
                    <div class="header-subtitle">New Studio Enquiry</div>
                </td>
            </tr>

            <!-- Body -->
            <tr>
                <td class="content">
                    <p class="intro">You have received a new enquiry via the website contact form.</p>

                    <!-- Contact Details -->
                    <table class="data-table" role="presentation">
                        <tr class="data-row">
                            <td class="label">Name</td>
                            <td class="value">{{ $name }}</td>
                        </tr>
                        <tr class="data-row">
                            <td class="label">Email</td>
                            <td class="value"><a href="mailto:{{ $email }}" style="color: #004aad; text-decoration: none;">{{ $email }}</a></td>
                        </tr>
                        @if($phone)
                        <tr class="data-row">
                            <td class="label">Phone</td>
                            <td class="value"><a href="tel:{{ $phone }}" style="color: #111827; text-decoration: none;">{{ $phone }}</a></td>
                        </tr>
                        @endif
                        @if($company)
                        <tr class="data-row">
                            <td class="label">Company</td>
                            <td class="value">{{ $company }}</td>
                        </tr>
                        @endif
                        <tr class="data-row">
                            <td class="label">Date</td>
                            <td class="value">{{ now()->format('M d, Y h:i A') }}</td>
                        </tr>
                    </table>

                    <!-- Message -->
                    <div class="message-box">
                        <span class="message-label">Message Content</span>
                        <p class="message-text">{{ $messageText }}</p>
                    </div>

                    <!-- CTA -->
                    <div style="text-align: center; margin-top: 35px;">
                        <a href="mailto:{{ $email }}" style="background-color: #000000; color: #ffffff; padding: 12px 25px; text-decoration: none; font-weight: 600; border-radius: 30px; font-size: 14px; display: inline-block;">Reply via Email</a>
                    </div>
                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td class="footer">
                    <p class="footer-text">
                        &copy; {{ date('Y') }} {{ config('company.name') }}. All rights reserved.
                    </p>
                    <p class="footer-text">
                        {{ implode(', ', config('company.address.lines')) }}
                    </p>
                    <p class="footer-text" style="margin-top: 15px;">
                        <a href="{{ url('/') }}" class="footer-link">Visit Website</a>
                    </p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>