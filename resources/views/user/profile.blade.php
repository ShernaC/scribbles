<x-layout>
    <div class="min-h-[calc(100vh-4rem)] flex items-center justify-center p-6">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-indigo-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <span class="text-2xl font-semibold text-white">
                        {{ substr($user->name, 0, 1) }}
                    </span>
                </div>
                <h1 class="text-3xl font-light text-gray-900 tracking-wide">Profile</h1>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 space-y-6">
                    <div class="group">
                        <div class="text-xs uppercase tracking-wider text-gray-400 mb-1 font-medium">Name</div>
                        <div class="text-gray-900 font-medium">{{ $user->name }}</div>
                    </div>

                    <div class="h-px bg-gray-100"></div>

                    <div class="group">
                        <div class="text-xs uppercase tracking-wider text-gray-400 mb-1 font-medium">Email</div>
                        <div class="text-gray-900 font-medium">{{ $user->email }}</div>
                    </div>

                    <div class="h-px bg-gray-100"></div>

                    <div class="group">
                        <div class="text-xs uppercase tracking-wider text-gray-400 mb-1 font-medium">Member Since</div>
                        <div class="text-gray-900 font-medium">{{ $user->created_at->format('F j, Y') }}</div>
                    </div>

                    <div class="h-px bg-gray-100"></div>

                    <div class="group">
                        <div class="text-xs uppercase tracking-wider text-gray-400 mb-1 font-medium">Status</div>
                        @if($user->email_verified_at)
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-gray-900 font-medium">Verified</span>
                                <span class="text-xs text-gray-500">{{ $user->email_verified_at->format('M j, Y') }}</span>
                            </div>
                        @else
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-amber-500 rounded-full"></div>
                                <span class="text-gray-900 font-medium">Pending Verification</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>