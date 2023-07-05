<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-1">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-row">
                    <div class="basis-3/5">
                        <div class="m-3">
                            <input type="text" id="searchInput" placeholder="Search..."
                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    <div class="basis-1/5 m-3 flex justify-center">
                        <button onclick="searchChat()"
                            class="relative inline-flex items-center px-2 py-2 border border-gray-200 bg-white text-xs font-medium text-gray-700">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <button onclick="filterChat()"
                            class="ml-1 relative inline-flex items-center px-2 py-2 border border-gray-200 bg-white text-xs font-medium text-gray-700">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                    </div>
                    <div class="basis-2/5 m-3">
                        <nav class="relative inline-flex shadow-sm" aria-label="Pagination">
                            <a href="#"
                                class="relative inline-flex items-center px-1 py-2 rounded-l-md border border-gray-200 bg-white text-xs font-medium text-gray-500 hover:bg-gray-50">
                                <i class="fa fa-angle-double-left px-1"></i>
                            </a>
                            <a href="#"
                                class="relative inline-flex items-center px-2 py-2 border border-gray-200 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50">
                                <i class="fa fa-angle-left"></i>
                            </a>

                            <span
                                class="relative inline-flex items-center px-2 py-2 border border-gray-200 bg-white text-xs font-medium text-gray-700">
                                1/4
                            </span>

                            <a href="#"
                                class="relative inline-flex items-center px-2 py-2 border border-gray-200 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50">
                                <i class="fa fa-angle-right"></i>
                            </a>
                            <a href="#"
                                class="relative inline-flex items-center px-1 py-2 rounded-r-md border border-gray-200 bg-white text-xs font-medium text-gray-500 hover:bg-gray-50">
                                <i class="fa fa-angle-double-right px-1"></i>
                            </a>
                        </nav>
                    </div>
                </div>

                <div class="grid justify-items-center">
                    <div class="mb-2 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                            data-tabs-toggle="#myTabContent" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button class="inline-block relative p-4 border-b-2 rounded-t-lg" id="profile-tab"
                                    data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Conversation
                                    <div id="coversationCount"
                                        class="absolute  inline-flex items-center justify-center w-6 h-5 text-xs font-bold text-white bg-red-500 border-2  border-white rounded-full left-22 top-0.5 right-1 dark:border-gray-900">
                                        0</div>
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block relative p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                                    aria-controls="dashboard" aria-selected="false">
                                    Notification
                                    <div
                                        class="absolute inline-flex items-center justify-center w-6 h-5 text-xs font-bold text-white bg-red-500 border-2  border-white rounded-full left-22 top-0.5 right-1 dark:border-gray-900">
                                        20</div>
                                </button>

                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                                    aria-controls="settings" aria-selected="false">News</button>
                            </li>
                        </ul>
                    </div>
                    <input type="hidden" name="activeTabsInput" id="activeTabsInput">
                    <div id="myTabContent" class="w-full p-3">
                        <div class="hidden p-2 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <div class="flex flex-row drop-shadow-xl">
                                <div class="basis-2/4">
                                    <select id="users"
                                        class="block bg-white w-full p-2 mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value='' selected>Choose a User</option>
                                        @foreach ($users as $user)
                                            @if ($user->id != auth()->id())
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="basis-2/4 ml-2">
                                    <select id="days"
                                        class="block bg-white w-full p-2 mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value='1' selected>7 Days</option>
                                        <option value='2'>Today</option>
                                        <option value="3">Yesterday & Today</option>
                                        <option value="4">1 Month</option>
                                        <option value="5">2 Month</option>
                                    </select>
                                </div>
                            </div>
                            <div class=" w-full overflow-y-auto h-80" id="chatContainer">
                            </div>
                            <div class="mt-5">
                                <form>
                                    <label for="chat" class="sr-only">Your message</label>
                                    <input type="file" id="fileInput" multiple>

                                    <div class="flex items-center px-3 py-2 rounded-lg bg-gray-300 dark:bg-gray-700">
                                        <button type="button" onclick="document.getElementById('fileInput').click();"
                                            class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                            <i class="fa fa-paperclip"></i>
                                            <span class="sr-only">Upload image</span>
                                        </button>
                                        <!-- <button type="button"
                                            class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Add emoji</span>
                                        </button> -->
                                        {{-- <textarea id="chatMessagetext" rows="1"
                                            class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Your message..."></textarea> --}}

                                        <div
                                            class="block mx-4 p-2.5 w-64 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <div id="chatMessagetext">
                                            </div>
                                        </div>


                                        <button type="button" id="sendMessageBtn"
                                            class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                            <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                                </path>
                                            </svg>
                                            <span class="sr-only">Send message</span>
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel"
                            aria-labelledby="dashboard-tab">
                            <div class="overflow-y-auto h-80">
                                <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                                    role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div>
                                        <span class="font-medium">Info alert!</span> Change a few things up and try
                                        submitting again.
                                    </div>
                                </div>
                                <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                                    role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div>
                                        <span class="font-medium">Danger alert!</span> Change a few things up and try
                                        submitting again.
                                    </div>
                                </div>
                                <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                                    role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div>
                                        <span class="font-medium">Success alert!</span> Change a few things up and try
                                        submitting again.
                                    </div>
                                </div>
                                <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                                    role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div>
                                        <span class="font-medium">Warning alert!</span> Change a few things up and try
                                        submitting again.
                                    </div>
                                </div>
                                <div class="flex items-center p-4 text-sm text-gray-800 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600"
                                    role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div>
                                        <span class="font-medium">Dark alert!</span> Change a few things up and try
                                        submitting again.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel"
                            aria-labelledby="settings-tab">
                            {{-- <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the
                                <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated
                                    content</strong>. Clicking another tab will toggle the visibility of this one for
                                the
                                next. The tab JavaScript swaps classes to control the content visibility and styling.
                            </p> --}}
                            <div class="overflow-y-auto h-80">

                                <div id="alert-additional-content-1"
                                    class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                                    role="alert">
                                    <div class="flex items-center">
                                        <svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                        </svg>
                                        <span class="sr-only">Info</span>
                                        <h3 class="text-lg font-medium">This is a info alert</h3>
                                    </div>
                                    <div class="mt-2 mb-4 text-sm">
                                        More info about this info alert goes here. This example text is going to run a
                                        bit
                                        longer so that you can see how spacing within an alert works with this kind of
                                        content.
                                    </div>
                                    <div class="flex">
                                        <button type="button"
                                            class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg class="-ml-0.5 mr-2 h-3 w-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 14">
                                                <path
                                                    d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                            </svg>
                                            View more
                                        </button>
                                        <button type="button"
                                            class="text-blue-800 bg-transparent border border-blue-800 hover:bg-blue-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-blue-600 dark:border-blue-600 dark:text-blue-400 dark:hover:text-white dark:focus:ring-blue-800"
                                            data-dismiss-target="#alert-additional-content-1" aria-label="Close">
                                            Dismiss
                                        </button>
                                    </div>
                                </div>
                                <div id="alert-additional-content-2"
                                    class="p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                                    role="alert">
                                    <div class="flex items-center">
                                        <svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                        </svg>
                                        <span class="sr-only">Info</span>
                                        <h3 class="text-lg font-medium">This is a danger alert</h3>
                                    </div>
                                    <div class="mt-2 mb-4 text-sm">
                                        More info about this info danger goes here. This example text is going to run a
                                        bit
                                        longer so that you can see how spacing within an alert works with this kind of
                                        content.
                                    </div>
                                    <div class="flex">
                                        <button type="button"
                                            class="text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                            <svg class="-ml-0.5 mr-2 h-3 w-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 14">
                                                <path
                                                    d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                            </svg>
                                            View more
                                        </button>
                                        <button type="button"
                                            class="text-red-800 bg-transparent border border-red-800 hover:bg-red-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-red-600 dark:border-red-600 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800"
                                            data-dismiss-target="#alert-additional-content-2" aria-label="Close">
                                            Dismiss
                                        </button>
                                    </div>
                                </div>
                                <div id="alert-additional-content-3"
                                    class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                                    role="alert">
                                    <div class="flex items-center">
                                        <svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                        </svg>
                                        <span class="sr-only">Info</span>
                                        <h3 class="text-lg font-medium">This is a success alert</h3>
                                    </div>
                                    <div class="mt-2 mb-4 text-sm">
                                        More info about this info success goes here. This example text is going to run a
                                        bit
                                        longer so that you can see how spacing within an alert works with this kind of
                                        content.
                                    </div>
                                    <div class="flex">
                                        <button type="button"
                                            class="text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                            <svg class="-ml-0.5 mr-2 h-3 w-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 14">
                                                <path
                                                    d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                            </svg>
                                            View more
                                        </button>
                                        <button type="button"
                                            class="text-green-800 bg-transparent border border-green-800 hover:bg-green-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-green-600 dark:border-green-600 dark:text-green-400 dark:hover:text-white dark:focus:ring-green-800"
                                            data-dismiss-target="#alert-additional-content-3" aria-label="Close">
                                            Dismiss
                                        </button>
                                    </div>
                                </div>
                                <div id="alert-additional-content-4"
                                    class="p-4 mb-4 text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                                    role="alert">
                                    <div class="flex items-center">
                                        <svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                        </svg>
                                        <span class="sr-only">Info</span>
                                        <h3 class="text-lg font-medium">This is a warning alert</h3>
                                    </div>
                                    <div class="mt-2 mb-4 text-sm">
                                        More info about this info warning goes here. This example text is going to run a
                                        bit
                                        longer so that you can see how spacing within an alert works with this kind of
                                        content.
                                    </div>
                                    <div class="flex">
                                        <button type="button"
                                            class="text-white bg-yellow-800 hover:bg-yellow-900 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-yellow-300 dark:text-gray-800 dark:hover:bg-yellow-400 dark:focus:ring-yellow-800">
                                            <svg class="-ml-0.5 mr-2 h-3 w-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 14">
                                                <path
                                                    d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                            </svg>
                                            View more
                                        </button>
                                        <button type="button"
                                            class="text-yellow-800 bg-transparent border border-yellow-800 hover:bg-yellow-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-yellow-300 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-gray-800 dark:focus:ring-yellow-800"
                                            data-dismiss-target="#alert-additional-content-4" aria-label="Close">
                                            Dismiss
                                        </button>
                                    </div>
                                </div>
                                <div id="alert-additional-content-5"
                                    class="p-4 border border-gray-300 rounded-lg bg-gray-50 dark:border-gray-600 dark:bg-gray-800"
                                    role="alert">
                                    <div class="flex items-center">
                                        <svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                        </svg>
                                        <span class="sr-only">Info</span>
                                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">This is a dark
                                            alert</h3>
                                    </div>
                                    <div class="mt-2 mb-4 text-sm text-gray-800 dark:text-gray-300">
                                        More info about this info dark goes here. This example text is going to run a
                                        bit
                                        longer so that you can see how spacing within an alert works with this kind of
                                        content.
                                    </div>
                                    <div class="flex">
                                        <button type="button"
                                            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-800">
                                            <svg class="-ml-0.5 mr-2 h-3 w-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 14">
                                                <path
                                                    d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                            </svg>
                                            View more
                                        </button>
                                        <button type="button"
                                            class="text-gray-800 bg-transparent border border-gray-700 hover:bg-gray-800 hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:ring-gray-800 dark:text-gray-300 dark:hover:text-white"
                                            data-dismiss-target="#alert-additional-content-5" aria-label="Close">
                                            Dismiss
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            var filter = '';
            var search = '';


            function handleFileSelect(event) {
                var files = event.target.files;
                var output = document.getElementById("output");

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    output.innerHTML += '<li>' + file.name + '</li>';
                }
            }

            function searchChat() {
                search = true;
                filter = '';

                fetchChats();
            }

            function filterChat() {
                filter = true;
                search = '';
                fetchChats();
            }

            function fetchChats() {
                var user = $('#users').val();
                var searchInput = $('#searchInput').val();
                var days = $('#days').val();

                var getActiveTab = $('#activeTabsInput').val();



                $.ajax({
                    url: 'chat/show/all',
                    method: 'GET',
                    data: {
                        user: user,
                        searchInput: searchInput,
                        search: search,
                        filter: filter,
                        days: days

                    },
                    success: function(response) {
                        $('#chatContainer').empty();
                        response.forEach(function(chat) {
                            if ({{ Auth::id() }} == chat.from) {
                                chatRight(chat);

                            } else {
                                chatLeft(chat);

                            }
                            lastTime = chat.created_at;
                            scrollChatContainerToBottom();

                        });
                        // self.chats = response.data; // Menggunakan self untuk mengakses objek Alpine.js
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            function cekUnRead() {
                $.ajax({
                    url: 'chat/unread/all',
                    method: 'GET',
                    success: function(response) {
                        if (response > 0) {
                            fetchChats();
                        }
                        cekUnReadWidget();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            }

            function cekUnReadWidget() {
                $.ajax({
                    url: 'chat/unread/all',
                    method: 'GET',
                    success: function(response) {
                        if (response > 0) {
                            // Use jQuery to select the element by its ID
                            var conversationCount = $('#coversationCount');
                            var classToRemove = 'hidden';

                            // Set the new count using the text() function
                            conversationCount.text(response);
                            conversationCount.removeClass(classToRemove);

                        } else {
                            var conversationCount = $('#coversationCount');
                            var newClass = 'hidden';

                            conversationCount.addClass(function(index, currentClasses) {
                                return currentClasses + ' ' + newClass;
                            });

                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            }

            function scrollChatContainerToBottom() {
                var parentDiv = $('#chatContainer');
                var lastChildDiv = parentDiv.children().last();
                parentDiv.scrollTop(lastChildDiv.offset().top - parentDiv.offset().top + parentDiv.scrollTop());

            }

            function chatLeft(chat) {
                // Create the parent container element
                var parentDiv = $('<div></div>').addClass('mt-4').attr('id', 'chat' + chat.uuid);


                // Create the sender info element
                var senderInfo = $('<div></div>').addClass('text-sm fs-7 flex justify-between mr-2').text(
                    chat.user_from.name + '  - ' + formatDate(chat.created_at) + '   ');

                // Create the reply button
                var replyButton = $('<button></button>')
                    .addClass('reply-button mr-14')
                    .html('<i class="fa-solid fa-reply fa-2xs"></i> <small>Reply</small>')
                    .click(function() {
                        // Call the function to change the dropdown value
                        changeDropdownValue(chat.from);
                    });

                senderInfo.append(senderInfo, replyButton)



                if (chat.is_file == 1) {

                    var message = $('<div></div>').addClass(
                        'border rounded-lg p-2 bg-white text-start text-wrap ms-5 card card-body bg-green-200 chatright');

                    var href = $('<a></a>')
                        .text(chat.message)
                        .attr('href', '/uploads/' + chat.message)
                        .attr('target', '_blank');
                    message.append(href);

                } else {
                                 // Create the chat message element
                var message = $('<p></p>').addClass(
                        'max-w-[19rem] break-words border rounded-lg p-2 text-wrap me-5 card card-body bg-blue-100')
                    .html(chat
                        .message);
                }




                // Append inner container and message to parent container
                parentDiv.append(senderInfo, message);

                // Append parent container to the desired location in the DOM
                $('#chatContainer').append(parentDiv);


            }

            function chatRight(chat) {
                // Create the parent container element
                var parentDiv = $('<div></div>').addClass('ml-8 mt-4').attr('id', 'chat' + chat.uuid);

                // Create the inner container element
                var innerDiv = $('<div></div>').addClass('text-end');

                // Create the sender info element
                var senderInfo = $('<div></div>').addClass('text-sm fs-7').text(
                    chat.user_from.name + '  - ' + formatDate(chat.created_at));



                if (chat.is_file == 1) {

                    var message = $('<div></div>').addClass(
                        'border rounded-lg p-2 bg-white text-start text-wrap ms-5 card card-body bg-green-200 chatright');

                    var href = $('<a></a>')
                        .text(chat.message)
                        .attr('href', '/uploads/' + chat.message)
                        .attr('target', '_blank');
                    message.append(href);

                } else {
                    // Create the chat message element
                    var message = $('<p></p>').addClass(
                            'max-w-[19rem] break-words border rounded-lg p-2 bg-white text-start text-wrap ms-5 card card-body bg-green-200 chatright'
                        )
                        .html(chat
                            .message);
                }

                // Append sender info to inner container
                innerDiv.append(senderInfo);

                // Append inner container and message to parent container
                parentDiv.append(innerDiv, message);

                // Append parent container to the desired location in the DOM
                $('#chatContainer').append(parentDiv);

            }

            function chatRightAdd(chat) {
                // Create the parent container element
                var parentDiv = $('<div></div>').addClass('ml-8 mt-4').attr('id', 'chat' + chat.uuid);

                // Create the inner container element
                var innerDiv = $('<div></div>').addClass('text-end');

                // Create the sender info element
                var senderInfo = $('<div></div>').addClass('text-sm fs-7').text(
                    chat.userFrom.name + '  - ' + formatDate(chat.created_at));

                if (chat.is_file == 1) {
                    var message = $('<a></a>').addClass(
                            'border rounded-lg p-2 bg-white text-start text-wrap ms-5 card card-body bg-green-200')
                        .text(chat.message)
                        .attr('href', '/uploads/' + chat.file_name)
                        .attr('target', '_blank');
                } else {
                    // Create the chat message element
                    var message = $('<p></p>').addClass(
                            'border rounded-lg p-2 bg-white text-start text-wrap ms-5 card card-body bg-green-200')
                        .text(chat
                            .message);
                }




                // Append sender info to inner container
                innerDiv.append(senderInfo);

                // Append inner container and message to parent container
                parentDiv.append(innerDiv, message);

                // Append parent container to the desired location in the DOM
                $('#chatContainer').append(parentDiv);


                console.log(formatDateReturn(lastTime));

            }

            function changeDropdownValue(id) {
                $('#users').val(id);
            }

            function formatDate(datetime) {
                var dateObj = new Date(datetime);

                // Format the date portion as "d-m-Y"
                var formattedDate = dateObj.toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                }).replace(/\//g, '-');

                // Format the time portion as "h:i:s AM/PM"
                var formattedTime = dateObj.toLocaleTimeString('en-US', {
                    hour: 'numeric',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true
                });

                // Combine the formatted date and time
                var formattedDatetime = formattedDate + ' ' + formattedTime;

                return formattedDatetime;
            }

            function formatDateReturn(datetime) {
                var dateObj = new Date(datetime);

                var year = dateObj.getFullYear();
                var month = ('0' + (dateObj.getMonth() + 1)).slice(-2);
                var day = ('0' + dateObj.getDate()).slice(-2);

                var hours = ('0' + dateObj.getHours()).slice(-2);
                var minutes = ('0' + dateObj.getMinutes()).slice(-2);
                var seconds = ('0' + dateObj.getSeconds()).slice(-2);

                var formattedDatetime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' +
                    seconds;

                return formattedDatetime;
            }
            $('#users,#days').on('change', function() {
                fetchChats();
            });

            $('#fileInput').on('change', function() {
                var formData = new FormData();
                formData.append('fileInput', $('#fileInput')[0].files[0]);
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var to = $('#users').val();
                formData.append('to', to);

                if (to == '' || to == undefined) {
                    $('#fileInput').val(null); // Reset the file input field
                    return alert('Pilih User Terlebih Dahulu Yang Ingin Dikirim');
                }
                $.ajax({
                    url: "{{ route('uploadfilechat') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Set the CSRF token in the request header
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert(response);
                        $('#fileInput').val(null); // Reset the file input field
                        fetchChats();

                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });



            $('#sendMessageBtn').on('click', function() {
                // Get the message content from the user input or other source
                // var message = $('#chatMessagetext').val();
                const message = myEditor.getData(); // Get CKEditor value
                console.log(message);
                var to = $('#users').val();

                if (to == '' || to == undefined) {
                    return alert('Pilih User Terlebih Dahulu Yang Ingin Dikirim');
                }

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Make an AJAX request to the controller
                $.ajax({
                    url: '/chat',
                    method: 'POST',
                    data: {
                        _token: csrfToken, // Include the CSRF token in the data
                        message: message,
                        to: to,

                    },
                    success: function(response) {
                        // Handle the success response from the controller
                        console.log('Message saved successfully');
                        $('#chatMessagetext').val('');
                        myEditor.setData('');
                        // chatRightAdd(response.message);
                        fetchChats();

                    },
                    error: function(xhr, status, error) {
                        // Handle the error response from the controller
                        console.log('Error saving message');
                    }
                });
            });
            $(document).ready(function() {
                var lastTime;
                fetchChats();
                setInterval(() => {
                    var getActiveTab = $('#activeTabsInput').val();
                    if (getActiveTab == 'profile') {
                        cekUnRead();
                    } else {
                        cekUnReadWidget();
                    }
                }, 3000); // Panggil fetchChats setiap 5 detik (5000 milidetik)
                BalloonEditor
                    .create(document.querySelector('#chatMessagetext'), {
                        width: '100%',
                        placeholder: "Message...", // Set the placeholder text
                        toolbar: {
                            items: [
                                'link',
                                // More toolbar items.
                                // ...
                            ],
                        },
                        toolbarSize: "10px", // Set the toolbar size to small
                        link: {
                            // Automatically add target="_blank" and rel="noopener noreferrer" to all external links.
                            addTargetToExternalLinks: true,

                            // Let the users control the "download" attribute of each link.
                            decorators: [{
                                mode: 'manual',
                                label: 'Downloadable',
                                attributes: {
                                    download: 'download'
                                }
                            }]
                        }
                    })
                    .then(editor => {
                        console.log('Editor was initialized', editor);
                        myEditor = editor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        </script>
    @endpush
</x-app-layout>
