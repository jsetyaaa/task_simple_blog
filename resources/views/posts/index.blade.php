<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('My Own Posts') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto space-y-8 bg-white max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 space-y-6">
                <h2 class="text-lg font-semibold">Your Posts</h2>

                @forelse ($posts as $post)
                    <div class="p-5 border rounded-md shadow">
                        <div class="flex items-center gap-2">
                            @php
                                $statusColors = [
                                    'draft' => 'bg-gray-200 text-gray-700',
                                    'scheduled' => 'bg-yellow-100 text-yellow-800',
                                    'published' => 'bg-green-100 text-green-800',
                                ];
                            @endphp
                            <span
                                class="flex-none px-2 py-1 rounded capitalize {{ $statusColors[$post->status] ?? 'bg-gray-200 text-gray-700' }}">
                                {{ $post->status }}
                            </span>

                            <h3><a href="{{ route('posts.show', $post) }}" class="text-blue-500">{{ $post->title }}</a>
                            </h3>
                        </div>
                        <div class="flex items-end justify-between mt-4">
                            <div>
                                <div>Published: {{ $post->published_at }}</div>
                                <div>Updated: {{ $post->updated_at }}</div>
                            </div>
                            <div>
                                <a href="{{ route('posts.show', $post) }}" class="text-blue-500">Detail</a> /
                                <a href="{{ route('posts.edit', $post) }}" class="text-blue-500">Edit</a> /
                                <form id="delete-form-{{ $post->id }}" action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-red-500 delete-btn" data-id="{{ $post->id }}" data-title="{{ $post->title }}"
                                        >Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">You have no posts.</p>
                @endforelse

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
