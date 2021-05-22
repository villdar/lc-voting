<div class="idea-buttons-container"> <!-- Start idea-buttons-container -->

    <div class="flex mt-4 bg-white idea-container rounded-xl"> <!-- start idea container -->

        <div class="flex flex-col flex-1 px-4 py-6 md:flex-row">
            <div class="flex-none mx-4 md:mx-0">
                <a href="/">
                    <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="w-full mx-2 mt-4 md:mx-4 md:mt-0">
                <h4 class="text-xl font-semibold">
                    {{ $idea->title }}
                </h4>
                <div class="mt-3 text-gray-600">
                    {{ $idea->description }}
                </div>

                <div class="flex flex-col justify-between mt-6 md:flex-row md:items-center">
                    <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                        <div class="hidden font-bold text-gray-900 md:block">{{ $idea->user->name }}</div>
                        <div class="hidden md:block">&bull;</div>
                        <div>{{ $idea->created_at->diffForHumans() }}</div>
                        <div>&bull;</div>
                        <div>{{ $idea->category->name }}</div>
                        <div>&bull;</div>
                        <div class="text-gray-800">3 Comments</div>
                    </div>
                    <div class="flex items-center mt-2 space-x-2 md:mt-0" x-data="{isOpen: false}">
                        <div class="{{ $idea->status->classes }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">
                            {{ $idea->status->name }}
                        </div>
                        <div class="relative">
                            <button
                                @click="isOpen = !isOpen"
                                class="relative px-3 py-2 transition duration-150 ease-in bg-gray-100 border rounded-full hover:bg-gray-200 h-7"
                            >
                                <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                                </button>
                                <ul
                                    x-cloak
                                    x-show.transition.origin.top.left="isOpen"
                                    @click.away = "isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="absolute right-0 z-10 py-3 font-semibold text-left bg-white w-44 shadow-dialog rounded-xl md:ml-8 md:top-6 md:left-0"
                                >
                                    <li>
                                        <a href="#" class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">
                                            Edit idea
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">
                                            Delete idea
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">
                                            Mark as spam
                                        </a>
                                    </li>
                                </ul>
                        </div>
                    </div>
                    <div class="flex items-center mt-4 md:hidden md:mt-0">
                        <div class="h-10 px-4 py-2 pr-8 text-center bg-gray-100 rounded-xl">
                            <div class="text-sm font-bold leading-none @if($hasVoted) text-blue @endif">{{ $votesCount }}</div>
                            <div class="font-semibold leading-none text-gray-400 text-xxs">Votes</div>
                        </div>
                        @if ($hasVoted)
                            <button
                            wire:click.prevent="vote"
                            class="w-20 px-4 py-3 -mx-5 font-bold text-white uppercase transition duration-150 ease-in border bg-blue border-blue text-xxs rounded-xl hover:border-blue-hover">
                                Voted
                            </button>
                        @else
                            <button
                            wire:click.prevent="vote"
                            class="w-20 px-4 py-3 -mx-5 font-bold uppercase transition duration-150 ease-in bg-gray-200 border border-gray-200 text-xxs rounded-xl hover:border-gray-400">
                                Vote
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end idea container -->

    <div class="flex items-center justify-between mt-6 buttons-container">
        <div class="flex flex-col items-center ml-6 space-x-4 md:flex-row">
            <div class="relative" x-data="{isOpen: false}">

                <button
                    @click="isOpen = !isOpen"
                    type="button"
                    class="w-32 px-6 py-3 text-sm font-semibold text-white transition duration-150 ease-in border h-11 bg-blue rounded-xl border-blue hover:bg-blue-hover">
                        Reply
                </button>

                <div
                    x-cloak
                    x-show.transition.origin.top.left="isOpen"
                    @click.away = "isOpen = false"
                    @keydown.escape.window="isOpen = false"
                    class="absolute z-10 w-64 mt-2 text-sm font-semibold text-left bg-white md:w-104 shadow-dialog rounded-xl"
                >
                   <form action="#" class="px-4 py-6 space-y-4">
                       <div>
                           <textarea name="post_comment" id="post_comment" cols="30" rows="4" class="w-full px-4 py-2 text-sm placeholder-gray-900 bg-gray-100 border-none rounded-xl" placeholder="Go ahead, don't be shy. Share your thoughts ..."></textarea>

                       </div>
                       <div class="flex flex-col items-center md:flex-row md:space-x-3">

                           <button type="button" class="w-full px-6 py-3 text-xs font-semibold text-white transition duration-150 ease-in border h-11 md:w-1/2 bg-blue rounded-xl border-blue hover:bg-blue-hover">
                               Post comment
                           </button>

                           <button type="button" class="flex items-center justify-center w-full px-6 py-3 mt-2 text-xs font-semibold transition duration-150 ease-in bg-gray-200 border border-gray-200 md:w-32 h-11 rounded-xl hover:border-gray-400 md:mt-0">
                                <svg class="w-4 transform -rotate-45 teext-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <span class="ml-1">Attach</span>
                            </button>

                       </div>
                   </form>
                </div>

            </div>

            @if (auth()->check() && auth()->user()->isAdmin())
                <livewire:set-status :idea="$idea" />
            @endif

        </div>

        <div class="items-center hidden space-x-3 md:flex">

            <div class="px-3 py-2 font-semibold text-center bg-white rounded-xl">
                <div class="text-xl leading-snug @if($hasVoted) text-blue @endif">{{ $votesCount }}</div>
                <div class="text-xs leading-none text-gray-400">Votes</div>
            </div>
            @if ($hasVoted)
                <button
                wire:click.prevent="vote"
                type="button" class="w-32 px-6 py-3 text-xs font-semibold text-white uppercase transition duration-150 ease-in border h-11 bg-blue rounded-xl border-blue hover:border-blue-hover">
                    <span>Voted</span>
                </button>
            @else
                <button
                wire:click.prevent="vote"
                type="button" class="w-32 px-6 py-3 text-xs font-semibold uppercase transition duration-150 ease-in bg-gray-200 border border-gray-200 h-11 rounded-xl hover:border-gray-400">
                    <span>Vote</span>
                </button>
            @endif

        </div>

    </div> <!--  end buttons container -->

</div> <!-- end idea-buttons-container -->
