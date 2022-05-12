<x-app-layout>
    <x-slot name="header">
        <div class="block mb-5">
            <h2 class="font-semibold text-xl text-black leading-tight">
                {{ __('Staff Tickets List') }}
            </h2>
        </div>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-5 sm:px-6 lg:px-7">
            <div class="mx-auto pull-right">
                <div class="mb-5">
                    <div class="input-group">
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
                        <form action="{{ route('tickets.index') }}" method="GET" role="filter">
                            <div class="input-group">
                                <select name="filter" id="filter" class="form-control mr-2">
                                    <option disabled selected value="" selected style="display:none;">
                                        Select Ticket Filter View
                                    </option>
                                    <option value="priority-critical" >
                                        Priority: Critical
                                    </option>
                                    <option value="priority-high" >
                                        Priority: High
                                    </option>
                                    <option value="priority-medium" >
                                        Priority: Medium
                                    </option>
                                    <option value="priority-low" >
                                        Priority: Low
                                    </option>
                                    <option value="status-open" >
                                        Status: Open
                                    </option>
                                    <option value="status-in_progress" >
                                        Status: In Progress
                                    </option>
                                    <option value="status-closed" >
                                        Status: Closed
                                    </option>
                                    <option value="category-uncategorized" >
                                        Category: Uncategorized
                                    </option>
                                    <option value="category-pu_official_website" >
                                        Category: PU Official Website
                                    </option>
                                    <option value="category-aims" >
                                        Category: AIMS
                                    </option>
                                    <option value="category-google_classroom" >
                                        Category: Google Classroom
                                    </option>
                                    <option value="category-pu_email" >
                                        Category: PU Email
                                    </option>
                                    <option value="category-computer_laboratory" >
                                        Category: Computer Laboratory
                                    </option>
                                    <option value="category-school_wifi" >
                                        Category: School Wi-Fi
                                    </option>
                                    <option value="category-others" >
                                        Category: Others
                                    </option>
                                </select>
                                <span class="input-group-btn mr-5 mt-1">
                                        <button class="btn bg-green-500 text-white"  type="submit" title="Filter Tickets">
                                            Filter
                                        </button>
                                    </span>
                            </div>
                        </form>
                        <form action="{{ route('tickets.index') }}" method="GET" role="sortBy">
                            <div class="input-group">
                                <select name="sortBy" id="sortBy" class="form-control mr-2">
                                    <option disabled selected value="" selected style="display:none;">
                                        Select Ticket Sort View
                                    </option>
                                    <option value="ascending-ticket_id" >
                                        Ascending: Ticket ID
                                    </option>
                                    <option value="descending-ticket_id" >
                                        Descending: Ticket ID
                                    </option>
                                    </option>
                                    <option value="not_recently_created_at" >
                                        Not Recently Created
                                    </option>
                                    </option>
                                    <option value="recently_created" >
                                        Recently Created
                                    </option>
                                    <option value="not_recently_updated" >
                                        Not Recently Updated
                                    </option>
                                    <option value="recently_updated" >
                                        Recently Updated
                                    </option>
                                </select>
                                <span class="input-group-btn mr-5 mt-1">
                                        <button class="btn bg-green-500 text-white" type="submit" title="Sort Tickets">
                                            Sort By
                                        </button>
                                    </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-black-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-black-200 w-full">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-2 py-2 bg-black-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                            Ticket ID
                                        </th>
                                        <th scope="col" class="px-2 py-2 bg-black-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                            Subject
                                        </th>
                                        <th scope="col" class="px-2 py-2 bg-black-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                            Submit By
                                        </th>
                                        <th scope="col" class="px-2 py-2 bg-black-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                            Category
                                        </th>
                                        <th scope="col" class="px-2 py-2 bg-black-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-2 py-2 bg-black-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                            Priority
                                        </th>
                                        <th scope="col" class="px-2 py-2 bg-black-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                            Updated Date
                                        </th>
                                        <th scope="col" class="px-2 py-2 bg-black-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-black-200">
                                @foreach ($tickets as $ticket)
                                    <tr onclick="document.getElementById('{{ $ticket->id }}').click();" style="cursor: pointer" class="hover:bg-green-200">
                                        <a href="{{ route('tickets.show', $ticket->id) }}" id='{{ $ticket->id }}'>
                                            <td class="px-2 py-4 whitespace-nowrap text-sm text-center text-black">
                                                {{ $ticket->id }}
                                            </td>
                                            <td class="px-2 py-4 whitespace-nowrap text-sm text-black">
                                                {{ $ticket->subject }}
                                            </td>
                                            <td class="px-2 py-4 whitespace-nowrap text-sm text-black">
                                                {{ (DB::table('users')->where('id', ($ticket->user_id))->value('name')) }}
                                            </td>
                                            <td class="px-2 py-4 whitespace-nowrap text-sm text-black">
                                                {{ (DB::table('categories')->where('id', ($ticket->category_id))->value('title')) }}
                                            </td>
                                            <td class="px-2 py-4 whitespace-nowrap text-sm text-black">
                                                {{ (DB::table('statuses')->where('id', ($ticket->status_id))->value('title')) }}
                                            </td>
                                            <td class="px-2 py-4 whitespace-nowrap text-sm text-black">
                                                {{ (DB::table('priorities')->where('id', ($ticket->priority_id))->value('title')) }}
                                            </td>
                                            <td class="px-2 py-4 whitespace-nowrap text-sm text-black">
                                                {{ $ticket->updated_at }}
                                            </td>

                                            <td class="px-2 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('tickets.edit', $ticket->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>
                                            </td>
                                        </a>
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
