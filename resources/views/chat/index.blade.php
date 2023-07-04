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
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab"
                                    data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Conversation</button>
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
                    <div id="myTabContent" class="w-full p-3">
                        <div class="flex flex-row">
                            <div class="basis-2/4">
                                <select id="users"
                                    class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value='' selected>Choose a User</option>
                                    @foreach ($users as $user)
                                        @if ($user->id != auth()->id())
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="basis-2/4 ml-2">
                                <select id="countries"
                                    class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value='1' selected>Today</option>
                                    <option value="2">Yesterday & Today</option>
                                    <option value="3">1 Month</option>
                                    <option value="4">2 Month</option>
                                </select>
                            </div>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <div class=" w-full overflow-y-auto h-80" id="chatContainer">
                                {{-- <div class="">
                                    <div class="text-sm fs-7">Haris Lukman Hakim 12/06/2023 14:28 PM</div>
                                    <p class="border rounded-lg p-2 text-wrap me-5 card card-body bg-white">Lorem ipsum
                                        dolor sit amet,
                                        consectetur adipiscing elit,</p>
                                </div> --}}
                                {{-- <div class="ml-5 mt-3">
                                    <div class="text-end">
                                        <div class="text-sm fs-7">Haris Lukman Hakim 12/06/2023 14:28 PM</div>
                                        <p
                                            class="border rounded-lg p-2 bg-white text-start text-wrap ms-5 card card-body">
                                            Lorem ipsum dolor sit
                                            amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                            labore et
                                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                            ullamco
                                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur.
                                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                            deserunt mollit anim id est laborum.</p>
                                    </div>
                                </div> --}}
                                {{-- <div class="mt-3">
                                    <div class="text-sm fs-7">Haris Lukman Hakim 12/06/2023 14:28 PM</div>
                                    <p class="border rounded-lg p-2 text-wrap me-5 card card-body bg-white">Lorem ipsum
                                        dolor sit amet,
                                        consectetur adipiscing elit,</p>
                                </div>
                                <div class="mt-3">
                                    <div class="text-sm fs-7">Haris Lukman Hakim 12/06/2023 14:28 PM</div>
                                    <p class="border rounded-lg p-2 text-wrap me-5 card card-body bg-white">Lorem ipsum
                                        dolor sit amet,
                                        consectetur adipiscing elit,</p>
                                </div> --}}
                            </div>
                            <div class="mt-5">
                                <form>
                                    <label for="chat" class="sr-only">Your message</label>
                                    <div class="flex items-center px-3 py-2 rounded-lg bg-gray-300 dark:bg-gray-700">
                                        <button type="button"
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
                                        <textarea id="chatMessagetext" rows="1"
                                            class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Your message..."></textarea>
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
                            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the
                                <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated
                                    content</strong>. Clicking another tab will toggle the visibility of this one for
                                the
                                next. The tab JavaScript swaps classes to control the content visibility and styling.
                            </p>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel"
                            aria-labelledby="settings-tab">
                            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the
                                <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated
                                    content</strong>. Clicking another tab will toggle the visibility of this one for
                                the
                                next. The tab JavaScript swaps classes to control the content visibility and styling.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            var filter = '' ;
            var search = '';
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


                $.ajax({
                    url: 'chat/show/all',
                    method: 'GET',
                    data: {
                        user: user,
                        searchInput: searchInput,
                        search: search,
                        filter: filter

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


                // Create the chat message element
                var message = $('<p></p>').addClass(
                        'max-w-[19rem] break-words border rounded-lg p-2 text-wrap me-5 card card-body bg-blue-100')
                    .text(chat
                        .message);


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

                // Create the chat message element
                var message = $('<p></p>').addClass(
                        'max-w-[19rem] break-words border rounded-lg p-2 bg-white text-start text-wrap ms-5 card card-body bg-green-200')
                    .text(chat
                        .message);

                // Append sender info to inner container
                innerDiv.append(senderInfo);

                // Append inner container and message to parent container
                parentDiv.append(innerDiv, message);

                // Append parent container to the desired location in the DOM
                $('#chatContainer').append(parentDiv);


                console.log(formatDateReturn(lastTime));

            }

            function chatRightAdd(chat) {
                // Create the parent container element
                var parentDiv = $('<div></div>').addClass('ml-8 mt-4').attr('id', 'chat' + chat.uuid);

                // Create the inner container element
                var innerDiv = $('<div></div>').addClass('text-end');

                // Create the sender info element
                var senderInfo = $('<div></div>').addClass('text-sm fs-7').text(
                    chat.userFrom.name + '  - ' + formatDate(chat.created_at));

                // Create the chat message element
                var message = $('<p></p>').addClass(
                        'border rounded-lg p-2 bg-white text-start text-wrap ms-5 card card-body bg-green-200')
                    .text(chat
                        .message);

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
            $('#users').on('change', function() {
                fetchChats();
            });

            $('#sendMessageBtn').on('click', function() {
                // Get the message content from the user input or other source
                var message = $('#chatMessagetext').val();
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
                    cekUnRead();
                }, 3000); // Panggil fetchChats setiap 5 detik (5000 milidetik)




            });
        </script>
    @endpush

    {{-- <div class="bg-gray-100">

        <div class="container flex justify-center items-center h-screen">

         




        </div>

    </div> --}}
</x-app-layout>
