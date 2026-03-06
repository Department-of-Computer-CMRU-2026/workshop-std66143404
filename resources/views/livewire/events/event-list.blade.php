<div class="py-12 px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        {{-- Flash Messages --}}
        <div class="mb-10 space-y-4">
            @if (session()->has('message'))
                <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-2xl backdrop-blur-md flex items-center space-x-3 shadow-xl shadow-emerald-500/5">
                    <flux:icon.check-circle size="sm" variant="mini" />
                    <span class="font-bold text-sm">{{ session('message') }}</span>
                </div>
            @endif
            
            @if (session()->has('error'))
                <div class="p-4 bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 rounded-2xl backdrop-blur-md flex items-center space-x-3 shadow-xl shadow-rose-500/5">
                    <flux:icon.exclamation-triangle size="sm" variant="mini" />
                    <span class="font-bold text-sm">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        {{-- Welcome Header --}}
        <div class="relative mb-16">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <flux:heading size="xl" class="text-4xl lg:text-5xl font-black tracking-tight leading-none">
                        สำรวจ <span class="text-indigo-600 italic">Workshops</span>
                    </flux:heading>
                    <flux:subheading size="lg" class="mt-4 text-zinc-500 max-w-xl font-medium">
                        ค้นหาและเข้าร่วมกิจกรรมที่ช่วยยกระดับทักษะของคุณไปอีกขั้น พร้อมใบประกาศนียบัตรเมื่อเรียนจบ
                    </flux:subheading>
                </div>
                
                <div class="inline-flex items-center gap-4 bg-white dark:bg-zinc-800 p-2 rounded-2xl border border-zinc-200 dark:border-zinc-700 shadow-sm transition-all hover:shadow-md">
                    <div class="bg-indigo-600 text-white p-3 rounded-xl shadow-indigo-500/20 shadow-lg">
                        <flux:icon.calendar size="sm" />
                    </div>
                    <div class="pr-6">
                        <p class="text-[10px] font-black uppercase tracking-wider text-zinc-400 leading-none mb-1">สถานะการลงทะเบียน</p>
                        <p class="text-lg font-black leading-none">{{ $registrationCount }} <span class="text-zinc-400 font-medium">/ 3 หัวข้อ</span></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Events Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 lg:gap-10">
            @foreach($events as $event)
                @php
                    $isRegistered = in_array($event->id, $registeredEventIds);
                    $registeredCount = $event->registrations_count;
                    $isFull = $event->remaining_seats <= 0;
                    $reachedLimit = $registrationCount >= 3;
                @endphp
                
                <div class="group relative flex flex-col bg-white dark:bg-zinc-900 rounded-[2.5rem] border border-zinc-200 dark:border-zinc-800 p-10 transition-all duration-500 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-2 overflow-hidden">
                    {{-- Card Decoration --}}
                    <div class="absolute top-0 right-0 size-32 bg-indigo-500/5 rounded-bl-[4rem] pointer-events-none group-hover:scale-110 transition-transform duration-500"></div>
                    
                    <div class="flex-grow relative z-10">
                        <div class="flex justify-between items-start gap-4 mb-8">
                            <flux:heading size="lg" class="font-black text-2xl group-hover:text-indigo-600 transition-colors">{{ $event->title }}</flux:heading>
                            @if($isRegistered)
                                <flux:badge variant="success" size="sm" class="rounded-full px-3 py-1 font-black italic">REGISTERED</flux:badge>
                            @elseif($isFull)
                                <flux:badge variant="danger" size="sm" class="rounded-full px-3 py-1 font-black italic uppercase">Sold Out</flux:badge>
                            @endif
                        </div>
                        
                        <div class="space-y-5 mb-10">
                            <div class="flex items-center gap-4 group/icon">
                                <div class="size-10 rounded-xl bg-zinc-50 dark:bg-zinc-800 flex items-center justify-center text-zinc-400 group-hover/icon:bg-indigo-600 group-hover/icon:text-white transition-all">
                                    <flux:icon.user size="sm" />
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-zinc-400 mb-0.5">วิทยากร</p>
                                    <p class="font-bold text-zinc-800 dark:text-zinc-200">{{ $event->speaker }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 group/icon">
                                <div class="size-10 rounded-xl bg-zinc-50 dark:bg-zinc-800 flex items-center justify-center text-zinc-400 group-hover/icon:bg-indigo-600 group-hover/icon:text-white transition-all text-xs font-bold leading-none">
                                    <flux:icon.map-pin size="sm" />
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-zinc-400 mb-0.5">สถานที่</p>
                                    <p class="font-bold text-zinc-800 dark:text-zinc-200">{{ $event->location }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-zinc-50 dark:bg-zinc-800/50 rounded-2xl p-5 mb-4 border border-zinc-100 dark:border-white/5">
                            <div class="flex justify-between items-end mb-2">
                                <p class="text-[10px] font-black uppercase tracking-widest text-zinc-400">จำนวนความจุ</p>
                                <p class="text-sm font-black">{{ $registeredCount }} <span class="text-zinc-400 text-xs font-medium">/ {{ $event->total_seats }}</span></p>
                            </div>
                            <div class="w-full h-2 bg-zinc-200 dark:bg-zinc-700 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-600 transition-all duration-1000" style="width: {{ ($registeredCount / $event->total_seats) * 100 }}%"></div>
                            </div>
                            <p class="text-[10px] text-zinc-500 mt-2 font-medium">ว่าง <span class="font-black text-indigo-600 dark:text-indigo-400">{{ $event->remaining_seats }}</span> ที่นั่ง</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 relative z-10">
                        @if($isRegistered)
                            <flux:button disabled variant="filled" class="w-full py-4 rounded-[1.25rem] font-black tracking-wider text-sm bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-none">
                                ลงทะเบียนแล้ว
                            </flux:button>
                        @elseif($isFull)
                            <flux:button disabled variant="ghost" class="w-full py-4 rounded-[1.25rem] font-black tracking-wider text-sm opacity-50 italic">
                                ปิดรับสมัคร (ที่นั่งเต็ม)
                            </flux:button>
                        @elseif($reachedLimit)
                            <div class="w-full py-4 rounded-[1.25rem] bg-zinc-100 dark:bg-zinc-800 text-zinc-400 font-black text-xs text-center border border-dashed border-zinc-200 dark:border-zinc-700">
                                ครบโควต้า 3 หัวข้อแล้ว
                            </div>
                        @else
                            <flux:button 
                                wire:click="register({{ $event->id }})" 
                                wire:loading.attr="disabled"
                                variant="primary"
                                class="w-full py-4 rounded-[1.25rem] font-black tracking-wider text-sm bg-indigo-600 hover:bg-indigo-700 shadow-xl shadow-indigo-600/20 border-none transition-all active:scale-[0.98]"
                            >
                                <span wire:loading.remove wire:target="register({{ $event->id }})">ลงทะเบียนเข้าร่วม</span>
                                <span wire:loading wire:target="register({{ $event->id }})">กำลังประมวลผล...</span>
                            </flux:button>
                        @endif
                    </div>
                </div>
            @endforeach
            
            @if(count($events) === 0)
                <div class="col-span-full py-32 text-center bg-white dark:bg-zinc-900 rounded-[3rem] border border-dashed border-zinc-200 dark:border-zinc-800">
                    <div class="size-20 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-6 text-zinc-400">
                        <flux:icon.information-circle size="lg" />
                    </div>
                    <flux:heading size="lg" class="font-black">ไม่พบข้อมูลหัวข้อที่เปิดรับสมัคร</flux:heading>
                    <flux:subheading class="mt-2">โปรดติดตามข่าวสารความเคลื่อนไหวผ่านช่องทางประกาศสถาบัน</flux:subheading>
                </div>
            @endif
        </div>
    </div>
</div>

