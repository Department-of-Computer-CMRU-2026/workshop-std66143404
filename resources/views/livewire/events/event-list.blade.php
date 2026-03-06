<div class="p-6 lg:p-12">
    <div class="max-w-7xl mx-auto">
        {{-- Flash Messages --}}
        <div class="mb-8 space-y-4">
            @if (session()->has('message'))
                <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl flex items-center space-x-3">
                    <flux:icon.check-circle size="sm" variant="mini" class="text-emerald-500" />
                    <span class="font-medium text-sm">{{ session('message') }}</span>
                </div>
            @endif
            
            @if (session()->has('error'))
                <div class="p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-xl flex items-center space-x-3">
                    <flux:icon.exclamation-triangle size="sm" variant="mini" class="text-rose-500" />
                    <span class="font-medium text-sm">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        {{-- Header Section --}}
        <div class="mb-12">
            <flux:heading size="xl" level="1" class="text-black dark:text-white">Workshop ที่เปิดรับสมัคร</flux:heading>
            <flux:subheading size="lg" class="mt-2 text-black dark:text-zinc-400">คุณลงทะเบียนแล้ว <span class="text-indigo-600 dark:text-indigo-400 font-bold">{{ $registrationCount }} / 3</span> หัวข้อ</flux:subheading>
        </div>

        {{-- Events Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @foreach($events as $event)
                @php
                    $isRegistered = in_array($event->id, $registeredEventIds);
                    $registeredCount = $event->registrations_count;
                    $isFull = $event->remaining_seats <= 0;
                    $reachedLimit = $registrationCount >= 3;
                @endphp
                
                <flux:card class="flex flex-col h-full hover:shadow-lg transition-shadow duration-300">
                    <div class="flex-grow">
                        <div class="flex justify-between items-start gap-4 mb-6">
                            <flux:heading size="lg" class="text-black dark:text-white">{{ $event->title }}</flux:heading>
                            @if($isRegistered)
                                <flux:badge variant="success" size="sm">ลงทะเบียนแล้ว</flux:badge>
                            @elseif($isFull)
                                <flux:badge variant="danger" size="sm">เต็มแล้ว</flux:badge>
                            @endif
                        </div>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex items-center gap-3 text-black dark:text-zinc-400">
                                <flux:icon.user size="sm" variant="mini" />
                                <span class="text-sm">วิทยากร: <span class="font-bold text-black dark:text-white">{{ $event->speaker }}</span></span>
                            </div>
                            <div class="flex items-center gap-3 text-black dark:text-zinc-400">
                                <flux:icon.map-pin size="sm" variant="mini" />
                                <span class="text-sm">สถานที่: <span class="font-bold text-black dark:text-white">{{ $event->location }}</span></span>
                            </div>
                        </div>
                        
                        <div class="bg-zinc-50 dark:bg-zinc-800/50 p-4 rounded-xl border border-zinc-100 dark:border-zinc-700/50 flex items-center justify-between">
                            <div>
                                <p class="text-xs text-black dark:text-zinc-500 font-bold mb-1">ความจุที่นั่ง</p>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-2xl font-black text-indigo-600 dark:text-indigo-400">{{ $registeredCount }}</span>
                                    <span class="text-sm text-black dark:text-zinc-500 font-medium">/ {{ $event->total_seats }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-black dark:text-zinc-500 font-bold uppercase tracking-wider mb-1">คงเหลือ</p>
                                <div class="px-3 py-1 bg-indigo-500/10 border border-indigo-500/20 rounded-lg">
                                    <span class="text-sm font-black text-indigo-600 dark:text-indigo-400">{{ $event->remaining_seats }}</span>
                                    <span class="text-[10px] font-bold text-indigo-600/70 dark:text-indigo-400/70 ml-1">ที่นั่ง</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        @if($isRegistered)
                            <flux:button disabled variant="filled" class="w-full">ลงทะเบียนแล้ว</flux:button>
                        @elseif($isFull)
                            <flux:button disabled variant="ghost" class="w-full">ปิดรับสมัคร</flux:button>
                        @elseif($reachedLimit)
                            <flux:button disabled variant="ghost" class="w-full" title="คุณลงทะเบียนครบ 3 หัวข้อแล้ว">ครบโควต้าแล้ว</flux:button>
                        @else
                            <flux:button 
                                wire:click="register({{ $event->id }})" 
                                wire:loading.attr="disabled"
                                variant="primary"
                                class="w-full shadow-md hover:shadow-indigo-500/20"
                            >
                                <span wire:loading.remove wire:target="register({{ $event->id }})">ลงทะเบียน</span>
                                <span wire:loading wire:target="register({{ $event->id }})">...</span>
                            </flux:button>
                        @endif
                    </div>
                </flux:card>
            @endforeach
            
            @if(count($events) === 0)
                <div class="col-span-full py-20 text-center">
                    <flux:icon.information-circle size="xl" class="mx-auto text-zinc-300 dark:text-zinc-700 mb-4" />
                    <flux:heading size="lg">ยังไม่มี Workshop ที่เปิดรับสมัคร</flux:heading>
                    <flux:subheading>โปรดกลับมาตรวจสอบอีกครั้งในภายหลัง</flux:subheading>
                </div>
            @endif
        </div>
    </div>
</div>

