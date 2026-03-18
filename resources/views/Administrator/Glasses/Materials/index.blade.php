@extends('administrator.admin-layout-page')

@section('title', $pageTitle)

@section('content')

<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Glasses Materials</h1>

        <!-- Add New Button -->
        <a href="{{ route('Administrator.Glasses.Materials.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow transition duration-200">
            + Add New Item
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium">#</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Material Name</th>
                    <th class="px-6 py-3 text-center text-sm font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($glasses_materials as $index => $material)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                        <td class="px-6 py-3 text-sm text-gray-900">{{ $material->name }}</td>
                        <td class="px-6 py-3 text-center space-x-3">

                            <!-- Edit Button -->
                            <a href="{{ route('Administrator.Glasses.Materials.edit', $material->id) }}"
                               class="inline-block text-blue-500 hover:text-blue-700"
                               title="Edit">
                                ✏️
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('Administrator.Glasses.Materials.destroy', $material->id) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Are you sure you want to delete this material?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                    🗑️
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">No materials found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
