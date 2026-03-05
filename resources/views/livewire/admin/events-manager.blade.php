<div>
    <style>
        .admin-container {
            position: relative;
            min-height: calc(100vh - 4rem);
            overflow: hidden;
            background: #04040a;
            padding: 2rem 1rem;
            color: #e2e8f0;
        }

        /* ── Background Elements ── */
        .bg-scene {
            position: absolute;
            inset: 0;
            z-index: 0;
            background: radial-gradient(circle at 50% 0%, rgba(59, 130, 246, 0.15), transparent 50%),
                        radial-gradient(circle at 100% 100%, rgba(99, 102, 241, 0.1), transparent 50%);
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
            z-index: 0;
            opacity: 0.5;
        }
        .orb-1 { width: 400px; height: 400px; background: #3b82f6; top: -100px; left: -100px; animation: drift 20s infinite alternate; }
        .orb-2 { width: 350px; height: 350px; background: #6366f1; bottom: -50px; right: -50px; animation: drift 25s infinite alternate-reverse; }

        @keyframes drift { 
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(60px, 40px) scale(1.1); }
        }

        /* ── Glass Components ── */
        .glass-panel {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .modal-glass {
            background: rgba(10, 10, 18, 0.9);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.25rem;
            padding: 2.5rem;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.8);
        }

        /* ── Typography & UI ── */
        .page-title {
            font-size: 1.875rem;
            font-weight: 800;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.02em;
        }

        .btn-premium {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-blue {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.4);
        }
        .btn-blue:hover { transform: translateY(-2px); box-shadow: 0 15px 25px -5px rgba(59, 130, 246, 0.6); }

        /* ── Table Styling ── */
        .styled-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 1rem;
        }

        .styled-table th {
            text-align: left;
            padding: 1rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .styled-table td {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            vertical-align: middle;
        }

        .styled-table tr:last-child td { border-bottom: none; }
        .styled-table tr:hover td { background: rgba(255, 255, 255, 0.02); }

        .event-title { font-weight: 700; color: #f1f5f9; font-size: 1rem; }
        .event-meta { font-size: 0.875rem; color: #94a3b8; }

        .seat-tag {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .seat-remaining { color: #10b981; margin-top: 0.25rem; font-size: 0.75rem; font-weight: 600; }

        /* ── Form Inputs ── */
        .glass-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            color: white;
            transition: all 0.3s;
        }
        .glass-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: rgba(255, 255, 255, 0.06);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.2);
        }
        .label-premium { color: #94a3b8; font-weight: 600; font-size: 0.875rem; margin-bottom: 0.5rem; display: block; }
    </style>

    <div class="admin-container">
        <div class="bg-scene"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-panel">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-10 gap-4">
                    <div>
                        <h2 class="page-title">จัดการหัวข้อ Workshop</h2>
                        <p class="text-sm text-gray-500 mt-1">เพิ่ม แก้ไข และติดตามกิจกรรมทั้งหมดในระบบ</p>
                    </div>
                    <button wire:click="create" class="btn-premium btn-blue">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                        เพิ่มหัวข้อใหม่
                    </button>
                </div>

                @if($showModal)
                <div class="fixed inset-0 flex items-center justify-center z-50 p-4">
                    <div class="fixed inset-0 bg-black bg-opacity-80 backdrop-blur-sm" wire:click="closeModal"></div>
                    <div class="modal-glass w-full max-w-md relative z-10">
                        <h3 class="text-2xl font-800 text-white mb-8">{{ $editingEventId ? 'แก้ไข Workshop' : 'สร้าง Workshop ใหม่' }}</h3>
                        <form wire:submit="store" class="space-y-6">
                            <div>
                                <label class="label-premium">ชื่อหัวข้อ Workshop</label>
                                <input type="text" wire:model="title" class="glass-input" placeholder="ระบุชื่อหัวข้อ..." required>
                                @error('title') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="label-premium">วิทยากร</label>
                                    <input type="text" wire:model="speaker" class="glass-input" placeholder="ชื่อวิทยากร" required>
                                    @error('speaker') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="label-premium">สถานที่</label>
                                    <input type="text" wire:model="location" class="glass-input" placeholder="ห้องอบรม" required>
                                    @error('location') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div>
                                <label class="label-premium">จำนวนที่นั่งทั้งหมด</label>
                                <input type="number" wire:model="total_seats" class="glass-input" min="1" required>
                                @error('total_seats') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="flex justify-end gap-3 mt-10">
                                <button type="button" wire:click="closeModal" class="px-6 py-2.5 rounded-xl font-bold text-gray-400 hover:text-white transition">ยกเลิก</button>
                                <button type="submit" class="btn-premium btn-blue px-8">บันทึกข้อมูล</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>ชื่อหัวข้อ / วิทยากร</th>
                                <th>สถานที่</th>
                                <th>การลงทะเบียน</th>
                                <th class="text-right">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr wire:key="event-{{ $event->id }}">
                                <td>
                                    <div class="event-title">{{ $event->title }}</div>
                                    <div class="event-meta mt-1">
                                        <svg class="inline w-3.5 h-3.5 mr-1 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        {{ $event->speaker }}
                                    </div>
                                </td>
                                <td class="event-meta">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ $event->location }}
                                    </div>
                                </td>
                                <td>
                                    <span class="seat-tag">{{ $event->registrations_count }} / {{ $event->total_seats }}</span>
                                    <div class="seat-remaining">
                                        {{ $event->remaining_seats }} ว่าง
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="flex justify-end gap-4">
                                        <a href="{{ route('admin.events.registrations', $event->id) }}" class="text-blue-400 hover:text-blue-300 font-semibold text-sm transition" title="ดูผู้ลงทะเบียน" wire:navigate>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                        <button wire:click="edit({{ $event->id }})" class="text-gray-400 hover:text-white transition" title="แก้ไข">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </button>
                                        <button wire:click="delete({{ $event->id }})" class="text-red-400/60 hover:text-red-400 transition" title="ลบ" onclick="confirm('คุณต้องการลบหัวข้อ Workshop นี้ใช่ไหม?') || event.stopImmediatePropagation()">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($events) === 0)
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-600 font-medium italic">ยังไม่มีหัวข้อ Workshop ในขณะนี้...</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


