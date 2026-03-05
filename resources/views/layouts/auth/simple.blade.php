<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

            body {
                font-family: 'Inter', sans-serif;
                min-height: 100vh;
                display: flex;
                background: #0f0f13;
                color: #e2e8f0;
            }

            /* ─────────── Left panel ─────────── */
            .auth-left {
                flex: 1;
                display: none;
                position: relative;
                overflow: hidden;
                background: linear-gradient(135deg, #1a1a2e 0%, #16213e 40%, #0f3460 100%);
            }
            @media (min-width: 1024px) { .auth-left { display: flex; } }

            .auth-left-inner {
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 4rem;
                position: relative;
                z-index: 10;
                width: 100%;
                height: 100%;
            }

            /* animated glow orbs */
            .orb {
                position: absolute;
                border-radius: 50%;
                filter: blur(80px);
                opacity: 0.35;
                animation: float 8s ease-in-out infinite;
            }
            .orb-1 { width: 400px;height:400px;background:#6366f1;top:-100px;left:-100px; animation-delay:0s; }
            .orb-2 { width: 300px;height:300px;background:#8b5cf6;bottom:0;right:-80px;  animation-delay:2s; }
            .orb-3 { width: 200px;height:200px;background:#3b82f6;bottom:200px;left:50%; animation-delay:4s; }

            @keyframes float {
                0%,100% { transform: translateY(0) scale(1); }
                50%      { transform: translateY(-30px) scale(1.05); }
            }

            /* grid lines */
            .auth-left::after {
                content:'';
                position:absolute;
                inset:0;
                background-image: linear-gradient(rgba(99,102,241,.06) 1px, transparent 1px),
                                  linear-gradient(90deg, rgba(99,102,241,.06) 1px, transparent 1px);
                background-size: 40px 40px;
                z-index:1;
            }

            .left-badge {
                display: inline-flex;
                align-items: center;
                gap: .5rem;
                background: rgba(99,102,241,.18);
                border: 1px solid rgba(99,102,241,.35);
                border-radius: 999px;
                padding: .35rem 1rem;
                font-size: .75rem;
                font-weight: 600;
                letter-spacing: .1em;
                text-transform: uppercase;
                color: #a5b4fc;
                margin-bottom: 1.5rem;
                width: fit-content;
            }

            .left-title {
                font-size: 2.8rem;
                font-weight: 800;
                line-height: 1.15;
                color: #fff;
                margin-bottom: 1.25rem;
            }

            .left-title span {
                background: linear-gradient(90deg, #818cf8 0%, #a78bfa 50%, #60a5fa 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .left-desc {
                font-size: 1rem;
                color: #94a3b8;
                line-height: 1.7;
                max-width: 400px;
                margin-bottom: 2.5rem;
            }

            .feature-list { display: flex; flex-direction: column; gap: .85rem; }

            .feature-item {
                display: flex;
                align-items: center;
                gap: .75rem;
                font-size: .92rem;
                color: #cbd5e1;
            }

            .feature-icon {
                width: 2rem; height: 2rem;
                background: rgba(99,102,241,.2);
                border: 1px solid rgba(99,102,241,.3);
                border-radius: .5rem;
                display: flex; align-items: center; justify-content: center;
                flex-shrink: 0;
            }
            .feature-icon svg { width:1rem; height:1rem; stroke:#818cf8; }

            /* ─────────── Right panel ─────────── */
            .auth-right {
                width: 100%;
                max-width: 520px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 2.5rem 2rem;
                background: #13131a;
                position: relative;
            }
            @media (min-width: 1024px) { .auth-right { padding: 3rem 3.5rem; } }

            /* top accent line */
            .auth-right::before {
                content:'';
                position:absolute;
                top:0; left:0; right:0;
                height:3px;
                background: linear-gradient(90deg, #6366f1, #8b5cf6, #3b82f6);
            }

            .brand-area {
                display: flex;
                align-items: center;
                gap: .75rem;
                margin-bottom: 2.75rem;
            }

            .brand-icon {
                width: 2.5rem; height: 2.5rem;
                background: linear-gradient(135deg,#6366f1,#8b5cf6);
                border-radius: .6rem;
                display:flex;align-items:center;justify-content:center;
            }
            .brand-icon svg { width:1.25rem;height:1.25rem; stroke:#fff; }

            .brand-name { font-size: 1.1rem; font-weight: 700; color:#e2e8f0; }
            .brand-sub  { font-size: .75rem; color:#64748b; }

            .form-heading { font-size:1.6rem; font-weight:800; color:#f1f5f9; margin-bottom:.4rem; }
            .form-subtext { font-size:.88rem; color:#64748b; margin-bottom:2rem; }

            /* hint box */
            .hint-box {
                background: rgba(99,102,241,.08);
                border: 1px solid rgba(99,102,241,.2);
                border-radius: .6rem;
                padding: .85rem 1rem;
                font-size: .8rem;
                color: #94a3b8;
                margin-bottom: 1.75rem;
                line-height: 1.6;
            }
            .hint-box strong { color: #a5b4fc; }

            /* flux overrides */
            .auth-right flux\:input,
            .auth-right [data-flux-input] { margin-bottom: 1.2rem; }

            .auth-right flux\:button[variant="primary"],
            .auth-right [data-flux-button] {
                background: linear-gradient(90deg,#6366f1,#8b5cf6) !important;
                border: none !important;
                font-weight: 600 !important;
            }

        </style>
    </head>
    <body>
        <!-- Left branding panel -->
        <div class="auth-left">
            <div class="orb orb-1"></div>
            <div class="orb orb-2"></div>
            <div class="orb orb-3"></div>
            <div class="auth-left-inner">
                <div class="left-badge">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                    Senior-to-Junior Workshop
                </div>
                <h1 class="left-title">จัดการ Workshop<br><span>อย่างมีประสิทธิภาพ</span></h1>
                <p class="left-desc">
                    ระบบจัดการการลงทะเบียน Workshop สำหรับมหาวิทยาลัย
                    ติดตามที่นั่ง วิทยากร และรายชื่อผู้เข้าร่วมได้ง่ายดาย
                </p>
                <ul class="feature-list">
                    <li class="feature-item">
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        </span>
                        Admin — เพิ่ม / แก้ไข / ลบ หัวข้อ Workshop
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                        </span>
                        ดูรายชื่อผู้ลงทะเบียนแต่ละ Workshop
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        จำกัดสิทธิ์สูงสุด 3 Workshop ต่อนักศึกษา
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        </span>
                        ระบบ Role-Based Access Control
                    </li>
                </ul>
            </div>
        </div>

        <!-- Right form panel -->
        <div class="auth-right">
            <div class="brand-area">
                <div class="brand-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                </div>
                <div>
                    <div class="brand-name">{{ config('app.name', 'Workshop') }}</div>
                    <div class="brand-sub">Registration System</div>
                </div>
            </div>

            <h2 class="form-heading">ยินดีต้อนรับ 👋</h2>
            <p class="form-subtext">เข้าสู่ระบบเพื่อจัดการหรือลงทะเบียน Workshop</p>

            <div class="hint-box">
                🔑 <strong>Admin:</strong> admin@example.com / password &nbsp;|&nbsp;
                🎓 <strong>Student:</strong> student@example.com / password
            </div>

            <div class="flex flex-col gap-6">
                {{ $slot }}
            </div>
        </div>

        @fluxScripts
    </body>
</html>
