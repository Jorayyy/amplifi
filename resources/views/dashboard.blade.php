<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Amplifi Employee Portal') }}
            </h2>
            <div class="bg-teal-500 text-slate-900 font-bold px-4 py-2 rounded-full shadow-md">
                🏆 Your Score: {{ Auth::user()->points }} Points
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Side: Active Campaigns -->
            <div class="lg:col-span-2 space-y-6">
                <h3 class="text-2xl font-bold text-teal-400 mb-2">📢 Active Campaigns</h3>
                
                @if (session('status'))
                    <div class="p-4 bg-teal-900/50 border border-teal-500 text-teal-300 rounded-lg text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                @foreach ($contents as $campaign)
                    <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="text-xl font-bold text-white">{{ $campaign->title }}</h4>
                            <span class="bg-teal-400/20 text-teal-400 text-xs px-2 py-1 rounded font-semibold whitespace-nowrap">
                                +{{ $campaign->points_per_click }} Pts / Click
                            </span>
                        </div>
                        <p class="text-gray-400 text-sm mb-4">{{ $campaign->description }}</p>
                        
                        @php
                            $userLink = Auth::user()->sharableLinks->where('content_id', $campaign->id)->first();
                        @endphp

                        @if($userLink)
                            <div class="mt-4 p-3 bg-gray-900 rounded border border-gray-700 flex flex-col sm:flex-row justify-between items-center gap-2">
                                <code class="text-teal-400 text-xs break-all selection:bg-teal-500 selection:text-slate-900">{{ url('/share/' . $userLink->unique_code) }}</code>
                                <span class="text-xs text-emerald-400 font-medium whitespace-nowrap">✅ Ready to Share</span>
                            </div>
                        @else
                            <form action="{{ route('generate.link', $campaign->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-slate-900 uppercase tracking-widest hover:bg-teal-400 transition ease-in-out duration-150">
                                    Generate My Tracking Link
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Right Side: The Leaderboard -->
            <div class="space-y-6">
                <h3 class="text-2xl font-bold text-teal-400 mb-2">🏅 Leaderboard</h3>
                <div class="p-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-700">
                    <ol class="divide-y divide-gray-700">
                        @foreach($leaderboard as $index => $leader)
                            <li class="py-3 flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <span class="font-extrabold text-sm {{ $index == 0 ? 'text-yellow-400 text-lg' : ($index == 1 ? 'text-slate-300' : ($index == 2 ? 'text-amber-600' : 'text-gray-500')) }}">
                                        #{{ $index + 1 }}
                                    </span>
                                    <div>
                                        <div class="text-sm font-semibold text-white">
                                            {{ $leader->name }} 
                                            @if($leader->id === Auth::user()->id) <span class="text-teal-400 text-xs">(You)</span> @endif
                                        </div>
                                        <div class="text-xs text-gray-500">{{ $leader->department }}</div>
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-teal-400">{{ $leader->points }} pts</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
