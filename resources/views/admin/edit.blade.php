<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Modify ABM Marketing Play') }}
            </h2>
            <a href="{{ route('admin.index') }}" class="text-sm font-medium text-teal-400 hover:underline">
                ⬅ Back to Management Panel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-700">
                <h3 class="text-xl font-bold text-teal-400 mb-4">✏️ Edit Properties for: {{ $content->title }}</h3>

                @if ($errors->any())
                    <div class="p-4 mb-4 bg-red-900/50 border border-red-500 text-red-300 rounded-lg text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.update', $content->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Campaign Title</label>
                        <input type="text" name="title" value="{{ old('title', $content->title) }}" required class="w-full bg-gray-900 border border-gray-700 rounded-md text-white px-3 py-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Employee Instructions / Share Context</label>
                        <textarea name="instructions" rows="4" required class="w-full bg-gray-900 border border-gray-700 rounded-md text-white px-3 py-2 focus:ring-teal-500 focus:border-teal-500 text-sm">{{ old('instructions', $content->instructions) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Target Marketing Destination URL</label>
                        <input type="url" name="original_url" value="{{ old('original_url', $content->original_url) }}" required class="w-full bg-gray-900 border border-gray-700 rounded-md text-white px-3 py-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Base Click Value (Points)</label>
                        <input type="number" name="points_per_click" value="{{ old('points_per_click', $content->points_per_click) }}" required class="w-full bg-gray-900 border border-gray-700 rounded-md text-white px-3 py-2 focus:ring-teal-500 focus:border-teal-500 text-sm">
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-2">
                        <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-gray-700 text-white rounded-md text-sm hover:bg-gray-600 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-teal-500 text-slate-900 font-semibold rounded-md text-sm hover:bg-teal-400 transition">
                            Save Structural Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
