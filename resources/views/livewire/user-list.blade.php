<div wire:init="loadData" class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full text-center text-sm font-light">
                    <thead
                        class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-900">
                    <tr>
                        <th scope="col" class=" px-6 py-4">ID</th>
                        <th scope="col" class=" px-6 py-4">Name</th>
                        <th scope="col" class=" px-6 py-4">Email</th>
                        <th scope="col" class=" px-6 py-4">Phone</th>
                        <th scope="col" class=" px-6 py-4">Position ID</th>
                        <th scope="col" class=" px-6 py-4">Position</th>
                        <th scope="col" class=" px-6 py-4">Registration Timestamp</th>
                        <th scope="col" class=" px-6 py-4">Photo</th>
                        <th scope="col" class=" px-6 py-4">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users ?? [] as $user)
                        <tr class="border-b dark:border-neutral-500" wire:key="$loop->index()">
                            <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$user['id']}}</td>
                            <td class="whitespace-nowrap  px-6 py-4">{{$user['name']}}</td>
                            <td class="whitespace-nowrap  px-6 py-4">{{$user['email']}}</td>
                            <td class="whitespace-nowrap  px-6 py-4">{{$user['phone']}}</td>
                            <td class="whitespace-nowrap  px-6 py-4">{{$user['position_id']}}</td>
                            <td class="whitespace-nowrap  px-6 py-4">{{$user['position']}}</td>
                            <td class="whitespace-nowrap  px-6 py-4">{{$user['registration_timestamp']}}</td>
                            <td class="whitespace-nowrap  px-6 py-4 ml-4">
                                <img
                                    class="max-w-[50%] rounded border bg-white p-1 dark:border-neutral-700 dark:bg-neutral-800"
                                    src="{{\App\Facades\FileUploader::fileUrl($user['photo'])}}"
                                >
                            </td>
                            <td class="whitespace-nowrap  px-6 py-4">
                                <a
                                    href="{{route('user.edit', $user['id'])}}"
                                    class="inline-block rounded-full bg-neutral-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] transition duration-150 ease-in-out hover:bg-neutral-800 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-neutral-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:outline-none focus:ring-0 active:bg-neutral-900 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] dark:bg-neutral-900 dark:shadow-[0_4px_9px_-4px_#030202] dark:hover:bg-neutral-900 dark:hover:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:focus:bg-neutral-900 dark:focus:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:active:bg-neutral-900 dark:active:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)]"
                                >
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                         <tr>
                             <td colspan="8">
                                 <button
                                     type="button"
                                     class="inline-block rounded-full bg-neutral-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] transition duration-150 ease-in-out hover:bg-neutral-800 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-neutral-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:outline-none focus:ring-0 active:bg-neutral-900 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] dark:bg-neutral-900 dark:shadow-[0_4px_9px_-4px_#030202] dark:hover:bg-neutral-900 dark:hover:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:focus:bg-neutral-900 dark:focus:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:active:bg-neutral-900 dark:active:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)]"
                                     wire:click="$emit('loadMoreData')"
                                 >
                                     Load more
                                 </button>
                             </td>
                         </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
