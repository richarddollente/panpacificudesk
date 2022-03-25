<x-app-layout>
    <x-slot name="header">
        <div class="block mb-5">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tickets List') }}
            </h2>
        </div>
        <a href="{{ route('tickets.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Create Ticket
        </a>

    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-5 sm:px-6 lg:px-7">
            <div class="mx-auto pull-right">
                <div class="mb-5">
                    <form action="{{ route('tickets.index') }}" method="GET" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control mr-2" name="query" placeholder="Search Tickets" id="query">
                            <span class="input-group-btn mr-5 mt-1">
                                <button class="btn bg-green-500 text-white" type="submit" title="Search Tickets">
                                    Search
                                </button>
                            </span>
                        </div>
                    </form>
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

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
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
