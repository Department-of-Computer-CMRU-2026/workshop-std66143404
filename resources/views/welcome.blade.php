<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Senior-to-Junior Workshop System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        :root {
            --indigo: #6366f1;
            --violet: #8b5cf6;
            --blue: #3b82f6;
            --emerald: #10b981;
            --surface: rgba(255, 255, 255, 0.03);
            --border: rgba(255, 255, 255, 0.08);
            --glow: rgba(99, 102, 241, 0.15);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            min-height: 100vh;
            background: #04040a;
            color: #e2e8f0;
            overflow-x: hidden;
            line-height: 1.5;
        }

        /* ── Background ── */
        .bg-scene {
            position: fixed;
            inset: 0;
            z-index: 0;
            background: 
                radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15), transparent 50%),
                radial-gradient(circle at 100% 100%, rgba(139, 92, 246, 0.1), transparent 50%),
                #04040a;
        }

        .grid-overlay {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image: 
                linear-gradient(rgba(99, 102, 241, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99, 102, 241, 0.05) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(circle at 50% 50%, black, transparent 80%);
        }

        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
            z-index: 0;
            opacity: 0.6;
        }
        .orb-1 { width: 600px; height: 600px; background: var(--indigo); top: -200px; left: -100px; animation: drift 20s infinite alternate; }
        .orb-2 { width: 500px; height: 500px; background: var(--violet); bottom: -150px; right: -100px; animation: drift 25s infinite alternate-reverse; }

        @keyframes drift {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(100px, 50px) scale(1.1); }
        }

        /* ── Navigation ── */
        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 5%;
            backdrop-filter: blur(20px);
            background: rgba(4, 4, 10, 0.7);
            border-bottom: 1px solid var(--border);
            transition: all 0.3s;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            transition: transform 0.3s;
        }
        .nav-brand:hover { transform: scale(1.02); }

        .nav-icon {
            width: 2.5rem; height: 2.5rem;
            background: linear-gradient(135deg, var(--indigo), var(--violet));
            border-radius: 0.75rem;
            display: flex; align-items: center; justify-content: center;
            position: relative;
        }
        .nav-icon::after {
            content: ''; position: absolute; inset: -2px; 
            border-radius: 0.85rem; background: inherit; filter: blur(8px); opacity: 0.5; z-index: -1;
        }

        .nav-title { font-size: 1.1rem; font-weight: 800; color: #fff; letter-spacing: -0.01em; }
        .nav-sub { font-size: 0.75rem; color: #64748b; font-weight: 500; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.5rem;
            border-radius: 0.75rem;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border: none;
        }
        .btn-ghost { color: #94a3b8; background: transparent; }
        .btn-ghost:hover { color: #fff; background: rgba(255, 255, 255, 0.05); }

        .btn-primary {
            color: #fff;
            background: linear-gradient(135deg, var(--indigo), var(--violet));
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
            position: relative; overflow: hidden;
        }
        .btn-primary::before {
            content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }
        .btn-primary:hover::before { left: 100%; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 15px 30px -5px rgba(99, 102, 241, 0.6); }

        /* ── Hero ── */
        .hero {
            position: relative;
            z-index: 10;
            padding: 8rem 5% 6rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .hero-badge {
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            padding: 0.5rem 1.25rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            color: #a5b4fc;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 2.5rem;
            display: flex; align-items: center; gap: 0.5rem;
            animation: fadeInDown 0.8s backwards;
        }
        .hero-badge span { width: 6px; height: 6px; background: #818cf8; border-radius: 50%; box-shadow: 0 0 10px #818cf8; }

        .hero-title {
            font-size: clamp(3rem, 8vw, 5.5rem);
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.04em;
            color: #fff;
            margin-bottom: 2rem;
            animation: fadeInUp 0.8s 0.2s backwards;
        }
        .hero-title .grad {
            background: linear-gradient(to right, #818cf8, #c084fc, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
        }
        
        .hero-desc {
            font-size: 1.25rem;
            color: #94a3b8;
            max-width: 650px;
            line-height: 1.6;
            margin-bottom: 3.5rem;
            animation: fadeInUp 0.8s 0.4s backwards;
        }

        .hero-cta { 
            display: flex; gap: 1.5rem; margin-bottom: 6rem;
            animation: fadeInUp 0.8s 0.6s backwards;
        }
        .btn-lg { padding: 1.1rem 2.5rem; font-size: 1.1rem; border-radius: 1rem; }
        
        .btn-outline {
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border);
        }
        .btn-outline:hover { background: rgba(255, 255, 255, 0.08); border-color: rgba(255,255,255,0.2); transform: translateY(-2px); }

        /* ── Feature Cards ── */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            width: 100%;
            max-width: 1200px;
            animation: fadeInUp 0.8s 0.8s backwards;
        }

        .card {
            position: relative;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 1.5rem;
            padding: 2.5rem;
            text-align: left;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }
        .card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: rgba(99, 102, 241, 0.4);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 20px rgba(99, 102, 241, 0.1);
        }

        .card::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(circle at var(--x, 50%) var(--y, 50%), rgba(99, 102, 241, 0.15), transparent 60%);
            opacity: 0; transition: opacity 0.3s;
        }
        .card:hover::before { opacity: 1; }

        .card-icon {
            width: 3.5rem; height: 3.5rem;
            border-radius: 1rem;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }
        .card-icon svg { width: 1.75rem; height: 1.75rem; stroke-width: 2; }
        
        .icon-1 { background: rgba(99, 102, 241, 0.15); color: #818cf8; }
        .icon-2 { background: rgba(139, 92, 246, 0.15); color: #a78bfa; }
        .icon-3 { background: rgba(59, 130, 246, 0.15); color: #60a5fa; }
        .icon-4 { background: rgba(16, 185, 129, 0.15); color: #34d399; }

        .card-title { font-size: 1.25rem; font-weight: 700; color: #fff; margin-bottom: 0.75rem; position: relative; z-index: 1; }
        .card-desc  { font-size: 0.95rem; color: #64748b; line-height: 1.6; position: relative; z-index: 1; }

        /* ── Animations ── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── Footer ── */
        footer {
            padding: 4rem 5% 2rem;
            text-align: center;
            color: #334155;
            font-size: 0.85rem;
            position: relative;
            z-index: 10;
        }

        @media (max-width: 768px) {
            nav { padding: 1rem 1.5rem; }
            .hero { padding-top: 6rem; }
            .hero-title { font-size: 3rem; }
            .hero-cta { flex-direction: column; width: 100%; max-width: 300px; }
            .cards-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="bg-scene"></div>
    <div class="grid-overlay"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="page">
        <!-- Navbar -->
        <nav id="navbar">
            <a href="#" class="nav-brand">
                <div class="nav-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <div>
                    <div class="nav-title">Workshop Systemmmm</div>
                    <div class="nav-sub">Senior-to-Junior</div>
                </div>
            </a>
            <div class="nav-actions" style="display: flex; gap: 1rem; align-items: center;">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost">เข้าสู่ระบบ</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">สมัครใช้งาน</a>
                @endauth
            </div>
        </nav>

        <!-- Hero -->
        <main class="hero">
            <div class="hero-badge">
                <span></span>
                Senior-to-Junior Platform
            </div>

            <h1 class="hero-title">
                เรียนรู้ พัฒนา<br>
                <span class="grad">เติบโตไปด้วยกัน</span>
            </h1>

            <p class="hero-desc">
                ระบบจัดการ Workshop ออนไลน์สำหรับมหาวิทยาลัย ค้นหาหัวข้อที่สนใจ
                เลือกวิทยากร และจองที่นั่งก่อนใครด้วยระบบที่ง่ายและรวดเร็ว
            </p>

            <div class="hero-cta">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                        ไปยัง Dashboard 
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                        เริ่มต้นใช้งาน
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline btn-lg">
                        สมัครเป็นนักศึกษา
                    </a>
                @endauth
            </div>

            <!-- Feature cards -->
            <div class="cards-grid">
                <div class="card">
                    <div class="card-icon icon-1">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                            <path d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                    </div>
                    <div class="card-title">จัดการ Workshop</div>
                    <div class="card-desc">Admin สามารถเพิ่ม แก้ไข และลบหัวข้อ Workshop พร้อมกำหนดที่นั่งและวิทยากร</div>
                </div>
                <div class="card">
                    <div class="card-icon icon-2">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                    </div>
                    <div class="card-title">ลงทะเบียนง่ายๆ</div>
                    <div class="card-desc">นักศึกษาสามารถดู Workshop ที่มีอยู่และลงทะเบียนได้สูงสุด 3 หัวข้อต่อคน</div>
                </div>
                <div class="card">
                    <div class="card-icon icon-3">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                            <rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
                        </svg>
                    </div>
                    <div class="card-title">ติดตาม Real-Time</div>
                    <div class="card-desc">แสดงจำนวนที่นั่งคงเหลือแบบ Real-Time ปิดรับสมัครอัตโนมัติเมื่อเต็ม</div>
                </div>
                <div class="card">
                    <div class="card-icon icon-4">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                            <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div class="card-title">ปลอดภัย &amp; เชื่อถือได้</div>
                    <div class="card-desc">ระบบ Role-Based Access Control แยก Admin และ Student อย่างชัดเจน</div>
                </div>
            </div>
        </main>

        <footer>
            &copy; {{ date('Y') }} Senior-to-Junior Workshop System &mdash; มหาวิทยาลัย
        </footer>
    </div>

    <script>
        // Spotlight effect
        document.querySelectorAll('.card').forEach(card => {
            card.onmousemove = e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                card.style.setProperty('--x', `${x}px`);
                card.style.setProperty('--y', `${y}px`);
            };
        });

        // Navbar scroll effect
        window.onscroll = () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.style.padding = '0.8rem 5%';
                nav.style.background = 'rgba(4, 4, 10, 0.9)';
            } else {
                nav.style.padding = '1.25rem 5%';
                nav.style.background = 'rgba(4, 4, 10, 0.7)';
            }
        };
    </script>
</body>
</html>

