<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Ticket
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('tickets.update', $ticket->id) }}">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="subject" class="block font-medium text-sm text-gray-700">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('subject', $ticket->subject) }}"/>
                            @error('subject')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                            <textarea type="text" name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-full"/>{{ old('description', $ticket->description) }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="category" class="block font-medium text-sm text-gray-700">Category</label>
                            <select name="category_id" id="category_id" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full">
                                @foreach($categories as $id => $categories)
                                    <option value="{{ $id }}"{{ old('category_id', $ticket->category_id) === $id ? ' selected' : '' }}>
                                        {{ $categories }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="priority" class="block font-medium text-sm text-gray-700">Priority</label>
                            <select name="priority_id" id="priority_id" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full">
                                @foreach($priorities as $id => $priorities)
                                    <option value="{{ $id }}"{{ old('priority_id', $ticket->priority_id) === $id ? ' selected' : '' }}>
                                        {{ $priorities }}
                                    </option>
                                @endforeach
                            </select>
                            @error('priorities')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                            <select name="status_id" id="status_id" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full">
                                @foreach($statuses as $id => $statuses)
                                    <option value="{{ $id }}"{{ old('status_id', $ticket->status_id) === $id ? ' selected' : '' }}>
                                        {{ $statuses }}
                                    </option>
                                @endforeach
                            </select>
                            @error('statuses')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="status" class="block font-medium text-sm text-gray-700">Admin Assigned</label>
                            <select name="admin_id" id="admin_id" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full">
                                @foreach($admins as $id => $admins)
                                    <option value="{{ $id }}"{{ old('admin_id', $ticket->admin_id) === $id ? ' selected' : '' }}>
                                        {{ $admins }}
                                    </option>
                                @endforeach
                            </select>
                            @error('admins')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Edit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
