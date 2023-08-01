<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
    <thead class="bg-gray-50 dark:bg-gray-800">
        <tr>
            <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                Id
            </th>

            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                Name and Email
            </th>

            <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                Role
            </th>

            <th scope="col" class="relative py-3.5 px-4">
                <span class="sr-only">Edit</span>
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
        <? foreach ($users as $user): ?>
            <tr wire:key="{{ $page->id }}">
                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                    <div>
                        <h2 class="font-medium text-gray-800 dark:text-white">
                            <?= $user['id'] ?>
                        </h2>
                    </div>
                </td>

                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                    <div>
                        <h2 class="font-medium text-gray-800 dark:text-white">
                            <?= $user['name'] ?>
                        </h2>
                        <p class="text-sm font-normal text-gray-600 dark:text-gray-400">
                            <?= $user['email'] ?>
                        </p>
                    </div>
                </td>
                
                <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                    <? if ($user['role_id'] == ADMIN_ROLE_ID): ?>
                        <div class="inline px-3 py-1 text-sm font-normal rounded-full 
                            text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                            Admin
                        </div>
                    <? else: ?>
                        <div class="inline px-3 py-1 text-sm font-normal text-gray-500 
                            bg-gray-100 rounded-full dark:text-gray-400 gap-x-2 dark:bg-gray-800">
                            User
                        </div>
                    <? endif; ?>
                </td>

                <td class="px-4 py-4 text-sm whitespace-nowrap flex justify-end">
                    
                    <a href="/admin/users/edit/<?=$user['id']?>" class="px-1 py-1 text-gray-500 transition-colors duration-200 rounded-lg 
                        dark:text-gray-300 dark:hover:bg-gray-800 hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-6 w-6"
                            x-tooltip="tooltip">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 
                                19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 
                                4.487zm0 0L19.5 7.125"
                            />
                        </svg>
                    </a>
                    
                    <form action="/admin/users/delete" method="post">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">  
                        <button type="submit" class="px-1 py-1 text-gray-500 transition-colors duration-200 rounded-lg 
                            dark:text-gray-300 dark:hover:bg-gray-800 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="h-6 w-6"
                                x-tooltip="tooltip">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 
                                    1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 
                                    2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 
                                    .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 
                                    013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 
                                    1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                />
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>