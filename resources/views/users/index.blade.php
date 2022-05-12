<x-app-layout>
    <x-slot name="header">
        <div class="block mb-5">
            <h2 class="font-semibold text-xl text-black-800 leading-tight">
                {{ __('User List') }}
            </h2>
        </div>
            <a href="{{ route('users.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Add User
            </a>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-5 sm:px-6 lg:px-7">
            <div class="mx-auto pull-right">
                <div class="mb-5">
                    <form action="{{ route('users.index') }}" method="GET" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control mr-2" name="query" placeholder="Search User" id="query">
                            <span class="input-group-btn mr-5 mt-1">
                                <button class="btn bg-green-500 text-white" type="submit" title="Search User">
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
                                        <th scope="col" class="px-2 py-2 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                            User ID
                                        </th>
                                        <th scope="col" class="px-2 py-2 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col" class="px-2 py-2 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col" class="px-2 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                            Roles
                                        </th>
                                        <th scope="col" class="px-2 py-2 bg-gray-50 text-left text-xs font-small text-black uppercase tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr onclick="document.getElementById('{{ $user->id }}').click();" style="cursor: pointer" class="hover:bg-green-200">
                                        <a href="{{ route('users.show', $user->id) }}" id='{{ $user->id }}'>
                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-black">
                                            {{ $user->id }}
                                        </td>
                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-black">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-black">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-black">
                                            @foreach ($user->roles as $role)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $role->title }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="px-2 py-4 whitespace-nowrap text-sm font-small">
                                            <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>
                                            <form class="inline-block" action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
                                            </form>
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
