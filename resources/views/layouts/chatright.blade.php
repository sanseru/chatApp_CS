<?php

use Faker\Factory as Faker;
use Carbon\Carbon;

$faker = Faker::create();

?>
<div class="p-2 rounded-lg bg-gray-50 dark:bg-gray-800">


    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
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
                            class="animate-bounce absolute inline-flex items-center justify-center w-6 h-5 text-xs font-bold text-white bg-red-500 border-2  border-white rounded-full left-22 top-0.5 right-1 dark:border-gray-900">
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

        <div id="myTabContent" class="w-full p-1">
            <div class="hidden p-0 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
                aria-labelledby="profile-tab">
                <div class="flex flex-row drop-shadow-xl">
                    <div class="basis-2/4">
                        <select id="users"
                            class="block w-full p-1 mb-2 text-xs pl-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value='' selected>Choose a User</option>
                            {{-- @foreach ($users as $user)
                                @if ($user->id != auth()->id())
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="basis-2/4 ml-2">
                        <select id="days"
                            class="block w-full p-1 pl-2 mb-2 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value='1' selected>7 Days</option>
                            <option value='2'>Today</option>
                            <option value="3">Yesterday & Today</option>
                            <option value="4">1 Month</option>
                            <option value="5">2 Month</option>
                        </select>
                    </div>
                </div>
                <div class="flex row justify-start ml-4">
                    <div id="burger-button" class="relative w-8 h-8 cursor-pointer">
                      <i class="fas fa-bars text-xs"></i>
                      <div id="options" class="hidden w-28 text-sm absolute right-0 mt-2 bg-white rounded shadow-md">
                        <ul class="py-2 px-1">
                          <li class="rounded-full text-xs hover:bg-blue-500"><a href="#" class="block ml-2 py-2 hover:text-white ">Option 1</a></li>
                          <li class="rounded-full text-xs hover:bg-blue-500"><a href="#" class="block ml-2 py-2 hover:text-white ">Option 2</a></li>
                          <li class="rounded-full text-xs hover:bg-blue-500"><a href="#" class="block ml-2 py-2 hover:text-white ">Option 3</a></li>
                        </ul>
                      </div>
                    </div>
                    <div id="listSubjectActive" class="text-sm font-extrabold grid content-center"></div>
                  </div>
                <div class=" w-full overflow-y-auto h-80">
                    <ul class="p-1" id="chatContainer">
                        @for ($i = 0; $i < 100; $i++)
                        @php
                            $countMessage = rand(0, 3);
                            $name =  $faker->sentence($nbWords = 6, $variableNbWords = true) ;
                        @endphp
                        {{-- x-data="{ countMessage: {{ $countMessage }} }" --}}
                        {{-- x-data="{ selected: false }" @click="selected = !selected" :class="{ 'selected': selected }" --}}
                            <li x-data="{ countMessage: {{ $countMessage }} }" class="pl-2 py-2 cursor-pointer drop-shadow-lg mb-2 block max-w-sm p-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                                data-id="Uji Coba" data-name="{{$name}}" id="{{$i}}">
                                <div class="flex">
                                    <div class="mr-4 flex items-stretch">
                                        <img src="{{ asset('profiles/60111.jpg') }}" alt="Image"
                                            class="w-10 h-15 self-center">
                                    </div>
                                    <div class="w-full">
                                        <p class="text-xs font-medium"><strong>Subject</strong>:
                                            <span
                                                class="text-xs">{{$name}}</span>
                                        </p>
                                        <p class="text-xs font-medium">With: {{ $faker->name }}</p>
                                        <p class="text-xs font-bold">
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $futureDate = $now->addDays(7);
                                                echo $now->format('d-m-y h:i:s') . ' - ' . $futureDate->format('d-m-y h:i:s');
                                            @endphp
                                        </p>
                                    </div>
                                    <div class="flex items-stretch">
                                       <span class=" w-5 h-5 self-center" onclick="alert('klikini')" x-show="countMessage > 0">
                                        <i class="fa-solid fa-chevron-right"></i>
                                       </span>
                                    </div>
                                </div>
                            </li>
                        @endfor
                    </ul>

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
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
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
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
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
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
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
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
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
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
                            <button type="button" onclick="alertData()"
                                class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-800">
                                <svg class="-ml-0.5 mr-2 h-3 w-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
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

<script>
    let globalVar = 'masuk sini';

    function alertData() {
        alert(masukPak);
    }
</script>
