@component('emails.layout', [
    'subject' => 'ইমেইল যাচাই করুন — '.config('app.name'),
    'preheader' => 'আপনার Prize Bond Bangladesh অ্যাকাউন্ট সক্রিয় করতে ইমেইল যাচাই করুন।',
])
    <h1 style="margin:0 0 12px 0;font-size:24px;font-weight:800;color:#0f172a;line-height:1.3;">
        স্বাগতম{{ $user->name ? ', '.$user->name : '' }}! 👋
    </h1>
    <p style="margin:0 0 16px 0;font-size:15px;line-height:1.7;color:#475569;">
        <strong style="color:#4f46e5;">{{ config('app.name', 'Prize Bond Bangladesh') }}</strong> এ আপনার অ্যাকাউন্ট তৈরি হয়েছে। এখন শুধু ইমেইল যাচাই করলেই আপনি আপনার ড্যাশবোর্ড ব্যবহার করতে পারবেন।
    </p>

    <p style="margin:0 0 24px 0;font-size:15px;line-height:1.7;color:#475569;">
        নিচের বাটনে ক্লিক করে যাচাই সম্পন্ন করুন —
    </p>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:0 0 28px 0;">
        <tr>
            <td align="center">
                <a href="{{ $url }}"
                   style="display:inline-block;background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%);color:#ffffff;text-decoration:none;padding:14px 32px;border-radius:12px;font-weight:700;font-size:15px;letter-spacing:0.2px;box-shadow:0 6px 18px rgba(79,70,229,0.35);">
                    ইমেইল যাচাই করুন
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

    <p style="margin:0;font-size:13px;line-height:1.6;color:#64748b;">
        ⏱️ এই লিংক <strong>{{ config('auth.verification.expire', 60) }} মিনিট</strong> এর জন্য বৈধ।
    </p>
@endcomponent
