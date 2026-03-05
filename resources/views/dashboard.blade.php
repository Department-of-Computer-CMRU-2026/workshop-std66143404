<x-layouts::app :title="__('Dashboard')">
    <style>
        .dashboard-container {
            position: relative;
            min-height: calc(100vh - 4rem);
            overflow: hidden;
            background: #080810;
            padding: 2rem 1rem;
        }

        /* ── Background Elements ── */
        .bg-scene {
            position: absolute;
            inset: 0;
            z-index: 0;
            background: radial-gradient(ellipse 80% 60% at 50% -10%, rgba(99,102,241,.15), transparent),
                        radial-gradient(ellipse 60% 50% at 80% 80%, rgba(139,92,246,.1), transparent);
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            pointer-events: none;
            z-index: 0;
        }
        .orb-1 {
            width: 400px; height: 400px;
            background: rgba(99,102,241,0.15);
            top: -100px; left: -100px;
            animation: drift 15s ease-in-out infinite alternate;
        }
        .orb-2 {
            width: 300px; height: 300px;
            background: rgba(139,92,246,0.12);
            bottom: -50px; right: -50px;
            animation: drift 18s ease-in-out infinite alternate-reverse;
        }

        @keyframes drift {
            from { transform: translate(0, 0) scale(1); }
            to { transform: translate(50px, 30px) scale(1.1); }
        }

        /* ── Glass Card ── */
        .glass-card {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1.5rem;
            padding: 3rem 2rem;
            max-width: 800px;
            margin: 2rem auto;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.3);
            color: #a5b4fc;
            padding: 0.5rem 1.25rem;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .welcome-title {
            font-size: 2.75rem;
            font-weight: 800;
            color: white;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        .welcome-title span {
            background: linear-gradient(to right, #818cf8, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .welcome-desc {
            font-size: 1.125rem;
            color: #94a3b8;
            max-width: 600px;
            margin: 0 auto 2.5rem;
            line-height: 1.6;
        }

        /* ── Action Buttons ── */
        .btn-premium {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            border-radius: 0.75rem;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn-indigo {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
        }

        .btn-indigo:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(99, 102, 241, 0.6);
        }

        .btn-blue {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
        }

        .btn-blue:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(59, 130, 246, 0.6);
        }

        .role-tag {
            font-weight: 700;
            color: #e2e8f0;
            padding: 0.25rem 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 0.375rem;
        }
    </style>

    <div class="dashboard-container">
        <div class="bg-scene"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-card">
                <div class="welcome-badge">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    ยินดีต้อนรับกลับมา
                </div>
                
                <h2 class="welcome-title">
                    Senior-to-Junior<br>
                    <span>Workshop Platform</span>
                </h2>
                
                @if(auth()->user()->isAdmin())
                    <p class="welcome-desc">
                        คุณเข้าสู่ระบบในฐานะ <span class="role-tag">ผู้ดูแลระบบ (Admin)</span><br>
                        จัดการหัวข้อ Workshop เพิ่มกิจกรรมใหม่ และติดตามรายชื่อผู้ลงทะเบียนได้ทันที
                    </p>
                    <a href="{{ route('admin.events') }}" class="btn-premium btn-blue" wire:navigate>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        จัดการ Workshop
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                @else
                    <p class="welcome-desc">
                        คุณเข้าสู่ระบบในฐานะ <span class="role-tag">นักศึกษา (Student)</span><br>
                        ค้นหาทักษะใหม่ ลงทะเบียนร่วม Workshop และยกระดับความรู้กับรุ่นพี่มืออาชีพ
                    </p>
                    <a href="{{ route('events') }}" class="btn-premium btn-indigo" wire:navigate>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        ดู Workshop ที่เปิดรับสมัคร
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-layouts::app>

