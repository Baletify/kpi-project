<x-app-layout :title="$title" :desc="$desc">
    <div class="ml-64 mt-4 overflow-x-auto p-2 bg-white border border-gray-100 shadow-md shadow-black/10 rounded-md">
        <div class="p-0">
            <span class="font-bold text-2xl">Send Reminder Input KPI</span>
        </div>

        <div class="mt-2">
            <table class="w-full table-fixed">
                <tr>
                    <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">
                        Reminder Input {{ "(10-15)" }}
                    </th>
                    <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">
                        Reminder Check 1 {{ "(10-15)" }}
                    </th>
                    <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">
                        Reminder Check 2 {{ "(15-20)" }}
                    </th>
                    <th class="border-2 border-gray-400 text-[14px] tracking-wide font-medium text-white py-1 px-4 bg-blue-700">
                        Reminder Mng Approval {{ "(20-25)" }}
                    </th>
                </tr>
                <tr>
                    <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0 text-center">
                        <form action="{{ route('actual.sendReminderInput') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 p-2  text-white rounded-md my-2">Kirim Reminder Input</button>
                        </form>
                    </td>
                    <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0 text-center">
                        <form action="{{ route('actual.sendReminderCheck1') }}" method="POST">
                            <button type="submit" class="bg-blue-500 p-2  text-white rounded-md my-2">Kirim Reminder Check 1</button>
                        </form>
                    </td>
                    <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0 text-center">
                        <form action="{{ route('actual.sendReminderCheck2') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 p-2  text-white rounded-md my-2">Kirim Reminder Check 2</button>
                        </form>
                    </td>
                    <td class="border-2 border-gray-400 text-[12px] tracking-wide px-2 py-0 text-center">
                        <form action="{{ route('actual.sendReminderMngApproval') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 p-2  text-white rounded-md my-2">Kirim Reminder Mng Approval</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</x-app-layout>