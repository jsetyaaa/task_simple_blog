<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-10 max-w-7xl sm:px-6 lg:px-8">

            {{-- for guest users --}}
            @guest
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p>
                            Welcome, guest! <br>
                            <a href="{{ route('login') }}" class="text-blue-500">Login</a> or
                            <a href="{{ route('register') }}" class="text-blue-500">Register</a> to manage your own posts.
                        </p>
                    </div>
                </div>
            @endguest

            {{-- for all users: display posts --}}
            <div class="mx-auto space-y-8 max-w-7xl sm:px-6 lg:px-8">
                <div class="p-5 overflow-hidden bg-white border rounded-md shadow">
                    @forelse ($posts as $post)
                        <div class="pb-4 mb-8 border-b">
                            <h3>
                                <a href="{{ route('posts.show', $post) }}" class="text-lg font-semibold text-blue-500">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <div class="flex justify-between mt-4 text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                        class="size-4 fill-gray-500">
                                        <path
                                            d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z" />
                                    </svg>
                                    <span>{{ $post->user->name }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="size-4 fill-gray-500">
                                        <path
                                            d="M256 8C119 8 8 119 8 256S119 504 256 504 504 393 504 256 393 8 256 8zm92.5 313h0l-20 25a16 16 0 0 1 -22.5 2.5h0l-67-49.7a40 40 0 0 1 -15-31.2V112a16 16 0 0 1 16-16h32a16 16 0 0 1 16 16V256l58 42.5A16 16 0 0 1 348.5 321z" />
                                    </svg>
                                    <span>{{ $post->published_at }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">No posts found.</p>
                    @endforelse

                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
