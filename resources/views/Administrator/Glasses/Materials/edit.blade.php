@extends('administrator.admin-layout-page')

@section('title', $pageTitle)

@section('content')
<div class="p-6">


    <div class="bg-white shadow-md rounded-lg p-6 max-w-lg">
        <form action="{{ route('Administrator.Glasses.Materials.update',$material->id) }}" method="POST" class="space-y-6">
            @csrf
             @method('PUT')
            <!-- Material Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Material Name</label>
                <input type="text" id="name" name="name"
                       class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Enter material name" value="{{ $material->name }}"  required>
            </div>
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg shadow transition duration-200">
                    Save Material
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
