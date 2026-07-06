<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white py-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-teal-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                </svg>
                {{ __('Amplifi Employee Portal') }}
            </h2>
            
           
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Global Score View -->
            <div class="p-6 bg-white shadow-sm sm:rounded-lg border border-gray-200 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium text-gray-700">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="text-xs text-gray-400">Amplify corporate reach to earn podium points.</p>
                </div>
                <div class="bg-teal-50 border border-teal-200 text-teal-700 px-4 py-2 rounded-lg font-bold text-base flex items-center gap-2">
                    <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-teal-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3-3h-15a3 3 0 0 1 3 3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-6.75c-.622 0-1.125.504-1.125 1.125v3.375m9 0h-9M9 10.5h.008v.008H9V10.5Zm6 0h.008v.008H15V10.5Zm-6 3h.008v.008H9v-.008Zm6 3h.008v.008H15v-.008ZM6 6h12a3 3 0 0 1 3 3v3a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V9a3 3 0 0 1 3-3Z" />
                    </svg>
                    Your Score: <span class="font-mono font-extrabold">{{ Auth::user()->points ?? 0 }} Points</span>
                </div>
            </div>

            <!-- Dashboard Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Active Campaigns Feed Column -->
                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-gray-500 flex items-center gap-2">
                        <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-teal-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" />
                        </svg>
                        Active Marketing Plays
                    </h3>

                    @if (session('status'))
                        <div class="p-4 bg-teal-50 border border-teal-200 text-teal-800 rounded-lg text-sm font-medium flex items-center gap-2">
                            <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-teal-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.03 0 1.9.693 2.166 1.638m-7.377 12.408 2.11 2.11a.75.75 0 0 0 1.06 0l4.22-4.22m-8.39 1.638H5.25A2.25 2.25 0 0 1 3 13.5v-7.5A2.25 2.25 0 0 1 5.25 3.75h3.333" />
                            </svg>
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($contents->isEmpty())
                        <div class="p-8 bg-white border border-gray-200 rounded-lg text-center text-gray-400 text-sm">
                            No campaigns are currently available. Check back soon!
                        </div>
                    @else
                        @foreach($contents as $content)
                            <div class="p-6 bg-white shadow-sm sm:rounded-lg border border-gray-200 hover:border-teal-400 transition duration-150">
                                <div class="flex justify-between items-start gap-4 mb-3">
                                    <div>
                                        <h4 class="text-base font-bold text-gray-900 leading-snug">{{ $content->title }}</h4>
                                        <p class="text-sm text-gray-600 mt-1 leading-relaxed">{{ $content->instructions }}</p>
                                    </div>
                                    <span class="bg-teal-50 text-teal-700 border border-teal-200 px-2.5 py-1 rounded text-xs font-mono font-bold whitespace-nowrap">
                                        +{{ $content->points_per_click }} Pts / Click
                                    </span>
                                </div>

                                <div class="mt-4 pt-4 border-t border-gray-100 flex flex-col items-center">
                                    @php
                                        $existingLink = $content->sharableLinks->where('user_id', Auth::id())->first();
                                    @endphp

                                    @if($existingLink)
                                        <div class="w-full text-center space-y-2">
                                            <div class="bg-gray-50 border border-gray-200 font-mono text-xs text-teal-700 px-3 py-2.5 rounded-md break-all select-all">
                                                {{ url('/share/' . $existingLink->unique_code) }}
                                            </div>
                                            <span class="inline-flex items-center gap-1.5 text-xs text-emerald-700 font-semibold bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                                                <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                                Ready to Share
                                            </span>
                                        </div>
                                    @else
                                        <form action="{{ route('generate.link', $content->id) }}" method="POST" class="w-full">
                                            @csrf
                                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-md text-sm transition">
                                                Generate My Tracking Link
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- Leaderboard Standings Column -->
                <div class="space-y-4">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-gray-500 flex items-center gap-2">
                        <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-teal-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 0 0 .495-7.467 5.99 5.99 0 0 0-1.925 3.546 5.974 5.974 0 0 1-2.133-1A3.75 3.75 0 0 0 12 18Z" />
                        </svg>
                        Top Advocates Standing
                    </h3>
                    <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 overflow-hidden">
                        <ul class="divide-y divide-gray-100">
                            @if($leaderboard->isEmpty())
                                <li class="p-6 text-center text-sm text-gray-400">No score records found.</li>
                            @else
                                @foreach($leaderboard as $index => $user)
                                    <li class="p-4 flex items-center justify-between {{ Auth::id() === $user->id ? 'bg-teal-50/50 font-semibold' : '' }}">
                                        <div class="flex items-center gap-3">
                                            <span class="w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold font-mono 
                                                {{ $index === 0 ? 'bg-amber-50 text-amber-800 border border-amber-200' : '' }}
                                                {{ $index === 1 ? 'bg-slate-50 text-slate-700 border border-slate-200' : '' }}
                                                {{ $index === 2 ? 'bg-orange-50 text-orange-800 border border-orange-200' : '' }}
                                                {{ $index > 2 ? 'bg-gray-50 text-gray-600' : '' }}">
                                                {{ $index + 1 }}
                                            </span>
                                            <span class="text-sm text-gray-800">{{ $user->name }}</span>
                                            @if(Auth::id() === $user->id)
                                                <span class="text-[10px] bg-teal-600 text-white px-1.5 py-0.5 rounded font-bold uppercase tracking-wider">You</span>
                                            @endif
                                        </div>
                                        <span class="text-sm font-mono font-bold text-gray-900">{{ $user->points }} pts</span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
