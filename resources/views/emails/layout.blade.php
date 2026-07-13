<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? config('app.name') }}</title>
    <!--[if mso]>
    <style type="text/css">table {border-collapse: collapse;} .fallback-font {font-family: Arial, sans-serif !important;}</style>
    <![endif]-->
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','SolaimanLipi','Kalpurush',Roboto,Helvetica,Arial,sans-serif;color:#1e293b;">
    <div style="display:none;font-size:1px;color:#f1f5f9;line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden;">
        {{ $preheader ?? '' }}
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f1f5f9;padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(15,23,42,0.06);">
                    {{-- Brand bar --}}
                    <tr>
                        <td style="background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 50%,#c026d3 100%);padding:24px 28px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td valign="middle" style="vertical-align:middle;">
                                        <img src="{{ asset('favicon/web-app-manifest-192x192.png') }}" alt="{{ config('app.name') }}" width="48" height="48" style="display:inline-block;vertical-align:middle;border:0;margin-right:12px;border-radius:8px;background:#ffffff;padding:4px;">
                                        <span style="display:inline-block;vertical-align:middle;color:#ffffff;">
                                            <span style="display:block;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;opacity:0.85;">Price Bond</span>
                                            <span style="display:block;font-size:18px;font-weight:800;line-height:1.2;">{{ config('app.name', 'Price Bond Bangladesh') }}</span>
                                        </span>
                                    </td>
                                    <td align="right" valign="middle" style="text-align:right;vertical-align:middle;">
                                        <span style="display:inline-block;background:rgba(255,255,255,0.18);color:#ffffff;padding:6px 12px;border-radius:999px;font-size:11px;font-weight:600;letter-spacing:0.4px;">
                                            নাগরিক পোর্টাল
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:36px 32px 8px 32px;">
                            {!! $slot !!}
                        </td>
                    </tr>

                    {{-- Divider --}}
                    <tr>
                        <td style="padding:0 32px;">
                            <div style="height:1px;background:#e2e8f0;margin:24px 0;"></div>
                        </td>
                    </tr>

                    {{-- Signature --}}
                    <tr>
                        <td style="padding:0 32px 28px 32px;font-size:13px;color:#64748b;line-height:1.7;">
                            যদি আপনি এই অনুরোধ না করে থাকেন, তাহলে এই ইমেইল উপেক্ষা করুন — কোনো পরিবর্তন হয়নি।
                            <br>
                            শুভেচ্ছান্তে,<br>
                            <strong style="color:#1e293b;">{{ config('app.name', 'Price Bond Bangladesh') }}</strong> টিম
                        </td>
                    </tr>
                </table>

                {{-- Footer --}}
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;margin-top:16px;">
                    <tr>
                        <td align="center" style="padding:12px 24px;font-size:12px;color:#94a3b8;line-height:1.6;">
                            © {{ date('Y') }} {{ config('app.name', 'Price Bond Bangladesh') }} — সকল অধিকার সংরক্ষিত।
                            <br>
                            এটি নাগরিকদের ব্যক্তিগত bond ট্র্যাকিং সহায়ক টুল, সরকারি অফিসিয়াল ঘোষণার বিকল্প নয়।
                            <br>
                            <a href="{{ url('/') }}" style="color:#4f46e5;text-decoration:none;font-weight:600;">{{ parse_url(url('/'), PHP_URL_HOST) }}</a>
                            &nbsp;·&nbsp;
                            <a href="{{ url(route('help', [], false)) }}" style="color:#4f46e5;text-decoration:none;">সহায়িকা</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
