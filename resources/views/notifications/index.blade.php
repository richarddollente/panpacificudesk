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
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($commentnotifications as $commentnotification)
                                    <tr onclick="document.getElementById('{{ $commentnotification->id }}').click();" style="cursor: pointer" class="hover:bg-green-200">
                                        <a href="{{ route('notifications.show', $commentnotification->id) }}" id='{{ $commentnotification->id }}'>
                                        <td height="50" class="px-6 py-4whitespace-nowrap text-sm text-gray-900">
                                            {{ str_replace('"', "", json_encode($commentnotification->data['username'])) }} commented on Ticket
                                            {{ str_replace('"', "", json_encode($commentnotification->data['ticket_id'])) }}:
                                            {{ json_encode($commentnotification->data['comment_body']) }}
                                        </td>
                                        </a>
                                    </tr>
                                @endforeach
                                @foreach ($newticketnotifications as $newticketnotification)
                                    <tr onclick="document.getElementById('{{ $newticketnotification->id }}').click();" style="cursor: pointer" class="hover:bg-green-200">
                                        <a href="{{ route('notifications.show', $newticketnotification->id) }}" id='{{ $newticketnotification->id }}'>
                                            <td height="50" class="px-6 py-4whitespace-nowrap text-sm text-gray-900">
                                                {{ str_replace('"', "", json_encode($newticketnotification->data['username'])) }} created  Ticket:
                                                {{ str_replace('"', "", json_encode($newticketnotification->data['ticket_id'])) }}
                                            </td>
                                        </a>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($updatedticketnotifications as $updatedticketnotification)
                                    <tr onclick="document.getElementById('{{ $updatedticketnotification->id }}').click();" style="cursor: pointer" class="hover:bg-green-200">
                                        <a href="{{ route('notifications.update', $updatedticketnotification->id) }}" id='{{ $updatedticketnotification->id }}'>
                                            <td height="50" class="px-6 py-4whitespace-nowrap text-sm text-gray-900">
                                                {{ str_replace('"', "", json_encode($updatedticketnotification->data['username'])) }} updated Ticket:
                                                {{ str_replace('"', "", json_encode($updatedticketnotification->data['ticket_id'])) }}
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
