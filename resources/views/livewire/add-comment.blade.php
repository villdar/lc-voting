<div
    class="relative"
    x-data="{isOpen: false}"
    x-init="

        window.livewire.on('commentWasAdded', () => {
            {{-- const LastComment = document.querySelector('.comment-container:last-child') --}}
            isOpen = false
        })

        Livewire.hook('message.processed', (message, component) => {

            {{-- if(message.updateQueue[0].method === 'gotoPage' || message.updateQueue[0].method === 'nextPage' || message.updateQueue[0].method === 'previousPage') { --}}
            if(['gotoPage', 'previousPage', 'nextPage'].includes(message.updateQueue[0].method)) {
                const firstComment = document.querySelector('.comment-container:first-child')
                firstComment.scrollIntoView({ behavior: 'smooth'})
            }


            if (message.updateQueue[0].payload.event === 'commentWasAdded' && message.component.fingerprint.name === 'idea-comments') {
                const lastComment = document.querySelector('.comment-container:last-child')
                lastComment.scrollIntoView({ behavior: 'smooth'})
                lastComment.classList.add('border-green')
                setTimeout(() => {
                    lastComment.classList.remove('border-green')
                }, 5000)
            }
        })
    "
>

    <button
            @click="
                isOpen = !isOpen
                if(isOpen) {
                    $nextTick(()=> $refs.comment.focus())
                }
            "
            type="button"
            class="w-32 px-6 py-3 text-sm font-semibold text-white transition duration-150 ease-in border h-11 bg-blue rounded-xl border-blue hover:bg-blue-hover">
        Reply
    </button>

    <div
         x-cloak
         x-show.transition.origin.top.left="isOpen"
         @click.away="isOpen = false"
         @keydown.escape.window="isOpen = false"
         class="absolute z-10 w-64 mt-2 text-sm font-semibold text-left bg-white md:w-104 shadow-dialog rounded-xl">
        @auth
            <form wire:submit.prevent="addComment" action="#" class="px-4 py-6 space-y-4">
                <div>
                    <textarea x-ref="comment" wire:model="comment" name="post_comment" id="post_comment" cols="30" rows="4" class="w-full px-4 py-2 text-sm placeholder-gray-900 bg-gray-100 border-none rounded-xl" required placeholder="Go ahead, don't be shy. Share your thoughts ..."></textarea>

                    @error('comment')
                        <p class="mt-1 text-xs text-red">{{ $message }}</p>
                    @enderror

                </div>
                <div class="flex flex-col items-center md:flex-row md:space-x-3">

                    <button type="submit" class="w-full px-6 py-3 text-xs font-semibold text-white transition duration-150 ease-in border h-11 md:w-1/2 bg-blue rounded-xl border-blue hover:bg-blue-hover">
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
        @else
            <div class="px-4 py-6">
                <p class="font-normal">Please login or create an account to post a comment.</p>
                <div class="flex items-center mt-8 space-x-3">
                    <a href="{{ route('login') }}" class="w-1/2 px-6 py-3 text-xs font-semibold text-center text-white transition duration-150 ease-in border h-11 bg-blue rounded-xl border-blue hover:bg-blue-hover">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="w-1/2 px-6 py-3 text-xs font-semibold text-center transition duration-150 ease-in bg-gray-200 border border-gray-200 h-11 rounded-xl hover:border-gray-400">
                        Register
                    </a>
                </div>
            </div>
        @endauth
    </div>

</div>
