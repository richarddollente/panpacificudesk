<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}

        </h2>
    </x-slot>
    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Notification
                                    </th>
                                    <th scope="col" class="px-2 py-2 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($notifications as $notification)
                                    <tr>
                                        <td class="px-6 py-4whitespace-nowrap text-sm text-gray-900">
                                            {{ str_replace('"', "", json_encode($notification->data['username'])) }} commented on Ticket {{ str_replace('"', "", json_encode($notification->data['ticket_id'])) }}: {{ json_encode($notification->data['comment_body']) }}
                                        </td>
                                        <td width="15" class="px-2 py-2 whitespace-nowrap text-sm text-gray-900">
                                            <a href="{{ route('notifications.update', $notification->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
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
