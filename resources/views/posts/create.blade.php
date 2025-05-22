<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('posts.store') }}" class="space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="block w-full mt-1" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="content" :value="__('Content')" />
                                <textarea id="content" name="content" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="6"></textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="published_at" :value="__('Publish Date')" />
                                <x-text-input id="published_at" name="published_at" type="datetime-local" class="block w-full mt-1" value="{{ old('published_at', isset($post) ? $post->published_at->format('Y-m-d\TH:i') : '') }}"/>
                                <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                            </div>

                            <div>
                                <label for="is_draft" class="inline-flex items-center">
                                    <input id="is_draft" type="checkbox" value="1" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="is_draft">
                                    <span class="text-sm text-gray-600 ms-2">{{ __('Save as Draft') }}</span>
                                </label>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Post') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
