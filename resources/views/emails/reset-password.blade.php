@component('emails.layout', [
    'subject' => 'পাসওয়ার্ড রিসেট — '.config('app.name'),
    'preheader' => 'আপনার Price Bond Bangladesh অ্যাকাউন্টের পাসওয়ার্ড রিসেট করুন।',
])
    <h1 style="margin:0 0 12px 0;font-size:24px;font-weight:800;color:#0f172a;line-height:1.3;">
        পাসওয়ার্ড রিসেট অনুরোধ 🔐
    </h1>
    <p style="margin:0 0 16px 0;font-size:15px;line-height:1.7;color:#475569;">
        হ্যালো{{ $user->name ? ' '.$user->name : '' }}, আমরা আপনার <strong style="color:#4f46e5;">{{ config('app.name', 'Price Bond Bangladesh') }}</strong> অ্যাকাউন্টের পাসওয়ার্ড রিসেটের অনুরোধ পেয়েছি।
    </p>

    <p style="margin:0 0 24px 0;font-size:15px;line-height:1.7;color:#475569;">
        নতুন পাসওয়ার্ড সেট করতে নিচের বাটনে ক্লিক করুন —
    </p>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:0 0 28px 0;">
        <tr>
            <td align="center">
                <a href="{{ $url }}"
                   style="display:inline-block;background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%);color:#ffffff;text-decoration:none;padding:14px 32px;border-radius:12px;font-weight:700;font-size:15px;letter-spacing:0.2px;box-shadow:0 6px 18px rgba(79,70,229,0.35);">
                    পাসওয়ার্ড রিসেট করুন
                </a>
            </td>
        </tr>
    </table>

    <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:14px 16px;margin:0 0 16px 0;">
        <p style="margin:0 0 6px 0;font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:1px;">
            বাটন কাজ না করলে
        </p>
        <p style="margin:0;font-size:12px;line-height:1.6;color:#475569;word-break:break-all;">
            এই লিংকটি আপনার ব্রাউজারে কপি-পেস্ট করুন:<br>
            <a href="{{ $url }}" style="color:#4f46e5;text-decoration:none;">{{ $url }}</a>
        </p>
    </div>

    <div style="background:#fef3c7;border:1px solid #fcd34d;border-radius:12px;padding:14px 16px;margin:0 0 8px 0;">
        <p style="margin:0;font-size:13px;line-height:1.6;color:#78350f;">
            ⏱️ এই লিংক <strong>{{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire', 60) }} মিনিট</strong> এর জন্য বৈধ। মেয়াদ শেষ হলে আবার অনুরোধ করুন।
        </p>
    </div>
@endcomponent
