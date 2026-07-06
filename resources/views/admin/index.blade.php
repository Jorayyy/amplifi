<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Amplifi Marketing Admin Panel') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm font-medium text-teal-400 hover:underline">
                ⬅ Back to Employee Portal
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Side Form: Create Campaign -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-700 h-fit">
                <h3 class="text-xl font-bold text-teal-400 mb-4">✨ Create New ABM Play</h3>
                
                @if (session('status'))
                    <div class="p-4 mb-4 bg-teal-900/50 border border-teal-500 text-teal-300 rounded-lg text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Validation Error Messages Box -->
                @if ($errors->any())
                    <div class="p-4 mb-4 bg-red-900/50 border border-red-500 text-red-300 rounded-lg text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Campaign Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="w-full bg-gray-900 border border-gray-700 rounded-md text-white px-3 py-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Employee Instructions / Share Context</label>
                        <textarea name="instructions" rows="3" required class="w-full bg-gray-900 border border-gray-700 rounded-md text-white px-3 py-2 focus:ring-teal-500 focus:border-teal-500 text-sm">{{ old('instructions') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Target Marketing Destination URL</label>
                        <input type="url" name="original_url" placeholder="https://..." value="{{ old('original_url') }}" required class="w-full bg-gray-900 border border-gray-700 rounded-md text-white px-3 py-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Base Click Value (Points)</label>
                        <input type="number" name="points_per_click" value="{{ old('points_per_click', 25) }}" required class="w-full bg-gray-900 border border-gray-700 rounded-md text-white px-3 py-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
                    </div>

                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-slate-900 uppercase tracking-widest hover:bg-teal-400 transition">
                        Deploy Campaign Card
                    </button>
                </form>
            </div>

            <!-- Right Side Table: Active Management Tracker -->
            <div class="lg:col-span-2 space-y-4">
                <h3 class="text-xl font-bold text-teal-400 mb-2">📊 Live Inventory Dashboard</h3>
                <div class="p-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-700 overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-400">
                        <thead class="text-xs uppercase bg-gray-900/50 text-gray-400 border-b border-gray-700">
                            <tr>
                                <th class="px-4 py-3">Campaign Details</th>
                                <th class="px-4 py-3 text-center">Value</th>
                                <th class="px-4 py-3 text-center">Links Engaged</th>
                                <th class="px-4 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @forelse($campaigns as $campaign)
                                <tr class="hover:bg-gray-700/20">
                                    <td class="px-4 py-4">
                                        <div class="text-white font-bold">{{ $campaign->title }}</div>
                                        <div class="text-xs text-gray-500 truncate max-w-xs">{{ $campaign->original_url }}</div>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="bg-teal-500/10 text-teal-400 px-2 py-0.5 rounded font-mono text-xs">
                                            +{{ $campaign->points_per_click }} pts
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center font-medium text-white">
                                        {{ $campaign->sharableLinks ? $campaign->sharableLinks->count() : 0 }} Employees
                                    </td>
                                    <td class="px-4 py-4 text-right space-x-2 whitespace-nowrap">
                                        <a href="{{ route('admin.edit', $campaign->id) }}" class="inline-flex items-center px-2.5 py-1.5 bg-gray-700 hover:bg-gray-600 text-teal-400 text-xs font-medium rounded transition">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.destroy', $campaign->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to permanently delete this campaign?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-2.5 py-1.5 bg-red-950/40 hover:bg-red-900/60 text-red-400 text-xs font-medium rounded border border-red-900/50 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                        No active marketing campaigns deployed yet. Create your first play on the left!
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
