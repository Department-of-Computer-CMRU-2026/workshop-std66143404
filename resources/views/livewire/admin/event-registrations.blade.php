
    <div>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('admin.events') }}" class="text-blue-600 hover:text-blue-800" wire:navigate>&larr; กลับไปหน้าจัดการ Workshop</a>
            </div>
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold">รายชื่อผู้ลงทะเบียน: {{ $event->title }}</h2>
                    <p class="text-gray-600 mt-1">วิทยากร: {{ $event->speaker }} | สถานที่: {{ $event->location }}</p>
                    <p class="text-gray-600">จำนวนผู้ลงทะเบียน: {{ $event->registrations->count() }} / {{ $event->total_seats }} ที่นั่ง</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ชื่อ-นามสกุล</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">อีเมล</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">วันที่ลงทะเบียน</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($event->registrations as $index => $registration)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap"><div class="font-medium text-gray-900">{{ $registration->user->name }}</div></td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $registration->user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endforeach
                            @if($event->registrations->isEmpty())
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">ยังไม่มีนักศึกษาลงทะเบียนหัวข้อนี้</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

