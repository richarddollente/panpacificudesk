<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Tickets List') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <button onclick="history.back()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Go Back
                </button>
            </div>

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        Ticket ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        Subject
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        Priority
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        Admin Assigned
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        Updated Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            {{ $ticket->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            {{ $ticket->subject }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            {{ (DB::table('categories')->where('id', ($ticket->category_id))->value('title')) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            {{ (DB::table('statuses')->where('id', ($ticket->status_id))->value('title')) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            {{ (DB::table('priorities')->where('id', ($ticket->priority_id))->value('title')) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                            {{ (DB::table('users')->where('id', ($ticket->admin_id))->value('name')) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
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
