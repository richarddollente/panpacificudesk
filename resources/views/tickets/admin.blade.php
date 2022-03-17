<x-app-layout>
    <x-slot name="header">
        <div class="block mb-5">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Tickets List') }}
            </h2>
        </div>
        <a href="{{ route('tickets.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Create Ticket
        </a>
        
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-5 sm:px-6 lg:px-7">
            <div class="block mb-5">
                <div class="input-group">
                    <div class="form-outline" action="{{ route('tickets.search') }}" method="GET">
                        <input type="text" name="query" id="query" class="form-input px-4 shadow-sm mt-1" value="" />
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Search
                        </button>
                    </div>

                  </div>
            </div>

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-2 py-2 bg-gray-50 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        Ticket ID
                                    </th>
                                    <th scope="col" class="px-2 py-2 bg-gray-50 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        Subject
                                    </th>
                                    <th scope="col" class="px-2 py-2 bg-gray-50 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        Submit By
                                    </th>
                                    <th scope="col" class="px-2 py-2 bg-gray-50 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th scope="col" class="px-2 py-2 bg-gray-50 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-2 py-2 bg-gray-50 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        Priority
                                    </th>
                                    <th scope="col" class="px-2 py-2 bg-gray-50 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        Admin Assigned
                                    </th>
                                    <th scope="col" class="px-2 py-2 bg-gray-50 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        Updated Date
                                    </th>
                                    <th scope="col" class="px-2 py-2 bg-gray-50 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $ticket->id }}
                                        </td>
                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $ticket->subject }}
                                        </td>
                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ (DB::table('users')->where('id', ($ticket->user_id))->value('name')) }}
                                        </td>
                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ (DB::table('categories')->where('id', ($ticket->category_id))->value('title')) }}
                                        </td>
                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ (DB::table('statuses')->where('id', ($ticket->status_id))->value('title')) }}
                                        </td>
                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ (DB::table('priorities')->where('id', ($ticket->priority_id))->value('title')) }}
                                        </td>
                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ (DB::table('users')->where('id', ($ticket->admin_id))->value('name')) }}
                                        </td>
                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $ticket->updated_at->diffForHumans() }}
                                        </td>

                                        <td class="px-2 py-4 whitespace-nowrap text-sm font-small">
                                            <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
                                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>
                                            <form class="inline-block" action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
