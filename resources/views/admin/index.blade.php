<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white py-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-teal-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>
                {{ __('Amplifi Marketing Admin Panel') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-teal-600 hover:text-teal-700 hover:underline flex items-center gap-1.5">
                <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                Back to Employee Portal
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Side Form: Create Campaign -->
            <div class="p-6 bg-white shadow-sm sm:rounded-lg border border-gray-200 h-fit">
                <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-1.5">
                    <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-teal-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create New ABM Play
                </h3>
                
                @if (session('status'))
                    <div class="p-4 mb-4 bg-teal-50 border border-teal-200 text-teal-800 rounded-lg text-sm font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-4 mb-4 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Campaign Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="w-full bg-white border border-gray-300 rounded-md text-gray-900 px-3 py-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Employee Instructions / Share Context</label>
                        <textarea name="instructions" rows="3" required class="w-full bg-white border border-gray-300 rounded-md text-gray-900 px-3 py-2 focus:ring-teal-500 focus:border-teal-500 text-sm">{{ old('instructions') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Target Marketing Destination URL</label>
                        <input type="url" name="original_url" placeholder="https://..." value="{{ old('original_url') }}" required class="w-full bg-white border border-gray-300 rounded-md text-gray-900 px-3 py-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Base Click Value (Points)</label>
                        <input type="number" name="points_per_click" value="{{ old('points_per_click', 25) }}" required class="w-full bg-white border border-gray-300 rounded-md text-gray-900 px-3 py-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
                    </div>

                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-md text-sm transition shadow-sm">
                        Deploy Campaign Card
                    </button>
                </form>
            </div>

            <!-- Right Side Table: Active Management Tracker -->
            <div class="lg:col-span-2 space-y-4">
                <h3 class="text-sm font-bold uppercase tracking-wider text-gray-500 flex items-center gap-2">
                    <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-teal-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                    </svg>
                    Live Inventory Dashboard
                </h3>
                <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 overflow-hidden">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="text-xs uppercase bg-gray-50 text-gray-700 font-bold border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3">Campaign Details</th>
                                <th class="px-4 py-3 text-center">Value</th>
                                <th class="px-4 py-3 text-center">Links Engaged</th>
                                <th class="px-4 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($campaigns as $campaign)
                                <tr class="hover:bg-gray-50/70 transition">
                                    <td class="px-4 py-4">
                                        <div class="text-gray-900 font-bold text-sm">{{ $campaign->title }}</div>
                                        <div class="text-xs text-gray-400 font-mono mt-0.5 truncate max-w-xs">{{ $campaign->original_url }}</div>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="bg-teal-50 text-teal-700 border border-teal-200 px-2 py-0.5 rounded font-mono text-xs font-bold">
                                            +{{ $campaign->points_per_click }} pts
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center font-medium text-gray-800">
                                        {{ $campaign->sharableLinks ? $campaign->sharableLinks->count() : 0 }} Employees
                                    </td>
                                    <td class="px-4 py-4 text-right space-x-2 whitespace-nowrap">
                                        <a href="{{ route('admin.edit', $campaign->id) }}" class="inline-flex items-center px-2.5 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded border border-gray-300 transition">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.destroy', $campaign->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to permanently delete this campaign?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-2.5 py-1.5 bg-red-50 hover:bg-red-100 text-red-700 text-xs font-bold rounded border border-red-200 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-12 text-center text-gray-400 text-sm">
                                        No active marketing campaigns deployed yet. Create your first play on the left!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

                        <!-- Full Width/Bottom Column: Automated Incentive Ledger -->
            <div class="lg:col-span-3 space-y-4 pt-4">
                <h3 class="text-sm font-bold uppercase tracking-wider text-gray-500 flex items-center gap-2">
                    <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-teal-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75H21m0 0v-.375c0-.621-.504-1.125-1.125-1.125H3.75m16.5 0v1.5a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 20.25 15h.75m-18 0h18M6.75 7.5h.008v.008H6.75V7.5Zm0 3h.008v.008H6.75v-.008Zm0 3h.008v.008H6.75v-.008Z" />
                    </svg>
                    Automated Incentive Ledger (KPI Milestone Payouts)
                </h3>
                <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 overflow-hidden">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="text-xs uppercase bg-gray-50 text-gray-700 font-bold border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3">Unsung Hero (Employee)</th>
                                <th class="px-4 py-3">Milestone Cleared</th>
                                <th class="px-4 py-3">Incentive Distributed</th>
                                <th class="px-4 py-3 text-center">Status</th>
                                <th class="px-4 py-3 text-right">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($rewardsLog as $reward)
                                <tr class="hover:bg-gray-50/70 transition">
                                    <td class="px-4 py-4">
                                        <div class="text-gray-900 font-bold text-sm">{{ $reward->employee_name }}</div>
                                        <div class="text-xs text-gray-400 font-mono">{{ $reward->employee_email }}</div>
                                    </td>
                                    <td class="px-4 py-4 font-medium text-gray-800">
                                        <span class="font-mono bg-gray-100 text-gray-700 px-2 py-0.5 rounded text-xs">
                                            {{ $reward->points_threshold }} pts
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-gray-900 font-semibold">
                                        {{ $reward->reward_type }}
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-flex items-center gap-1 text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 px-2.5 py-0.5 rounded-full">
                                            <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>
                                            Issued via Automation
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-right text-xs text-gray-500 font-mono">
                                        {{ \Carbon\Carbon::parse($reward->created_at)->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-400 text-sm">
                                        No automated incentive milestones achieved yet. Keep sharing ABM plays!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
