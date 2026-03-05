
    <div>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif
            
            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800">Workshop ที่เปิดรับสมัคร</h2>
                <p class="mt-1 text-gray-600">คุณลงทะเบียนแล้ว <strong>{{ $registrationCount }} / 3</strong> หัวข้อ</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($events as $event)
                    @php
                        $isRegistered = in_array($event->id, $registeredEventIds);
                        $isFull = $event->remaining_seats <= 0;
                        $reachedLimit = $registrationCount >= 3;
                    @endphp
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-gray-900">{{ $event->title }}</h3>
                                @if($isRegistered)
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-semibold">ลงทะเบียนแล้ว</span>
                                @elseif($isFull)
                                    <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-semibold">เต็มแล้ว</span>
                                @endif
                            </div>
                            
                            <p class="text-gray-600 mb-2"><span class="font-semibold">วิทยากร:</span> {{ $event->speaker }}</p>
                            <p class="text-gray-600 mb-4"><span class="font-semibold">สถานที่:</span> {{ $event->location }}</p>
                            
                            <div class="flex justify-between items-center mb-6">
                                <span class="text-sm text-gray-500 border rounded px-2 py-1 bg-gray-50">
                                    ที่นั่งว่าง {{ $event->remaining_seats }} / {{ $event->total_seats }} ที่นั่ง
                                </span>
                            </div>
                            
                            @if($isRegistered)
                                <button disabled class="w-full bg-gray-300 text-gray-600 font-bold py-2 px-4 rounded cursor-not-allowed">
                                    ลงทะเบียนแล้ว
                                </button>
                            @elseif($isFull)
                                <button disabled class="w-full bg-red-100 text-red-500 border border-red-200 font-bold py-2 px-4 rounded cursor-not-allowed">
                                    ปิดรับสมัคร
                                </button>
                            @elseif($reachedLimit)
                                <button disabled class="w-full bg-gray-200 text-gray-500 font-bold py-2 px-4 rounded cursor-not-allowed" title="คุณลงทะเบียนครบ 3 หัวข้อแล้ว">
                                    ครบโควต้าแล้ว
                                </button>
                            @else
                                <button wire:click="register({{ $event->id }})" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition">
                                    ลงทะเบียน
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
                
                @if(count($events) === 0)
                    <div class="col-span-full bg-white rounded-lg shadow p-6 text-center text-gray-500">
                        ยังไม่มี Workshop ที่เปิดรับสมัครในขณะนี้
                    </div>
                @endif
            </div>
        </div>
    </div>

