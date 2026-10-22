<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Author Dashboard: My Articles') }}
            </h2>
            <a href="{{ route('dashboard.posts.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-sm shadow-indigo-500/20 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create New Post
            </a>
        </div>
    </x-slot>

    <!-- Main Container with Alpine.js Delete Modal State -->
    <div x-data="{
            showDeleteModal: false,
            deleteUrl: '',
            postTitle: '',
            confirmDelete(url, title) {
                this.deleteUrl = url;
                this.postTitle = title;
                this.showDeleteModal = true;
            }
         }"
         class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Alpine.js Auto-Dismiss Flash Notification -->
            @if(session('success'))
                <div x-data="{ show: true }"
                     x-init="setTimeout(() => show = false, 4500)"
                     x-show="show"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="flex items-center justify-between p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm font-semibold">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" type="button" class="text-emerald-500 hover:text-emerald-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Author Overview Stat Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="p-6 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200/80 dark:border-gray-700/80 shadow-sm">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Articles</p>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white">{{ $posts->total() }}</p>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200/80 dark:border-gray-700/80 shadow-sm">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Author Profile</p>
                    <p class="mt-2 text-xl font-bold text-indigo-600 dark:text-indigo-400">@<span>{{ auth()->user()->username }}</span></p>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200/80 dark:border-gray-700/80 shadow-sm">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Public Profile</p>
                    <a href="{{ route('posts.index', ['author' => auth()->user()->username]) }}"
                       target="_blank"
                       class="mt-2 inline-flex items-center gap-1.5 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                        View Public Feed
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Posts Management Table -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200/80 dark:border-gray-700/80 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700/80 flex items-center justify-between">
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Published Articles</h3>
                </div>

                @if($posts->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50/80 dark:bg-gray-900/60 text-xs font-semibold uppercase text-gray-400 dark:text-gray-500 tracking-wider">
                                <tr>
                                    <th scope="col" class="py-3.5 px-6">Article</th>
                                    <th scope="col" class="py-3.5 px-6">Category</th>
                                    <th scope="col" class="py-3.5 px-6">Published</th>
                                    <th scope="col" class="py-3.5 px-6 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60">
                                @foreach($posts as $post)
                                    <tr class="hover:bg-gray-50/60 dark:hover:bg-gray-750 transition-colors">
                                        <!-- Title & Slug -->
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                @if($post->image)
                                                    <img src="{{ asset('storage/' . $post->image) }}"
                                                         alt="{{ $post->title }}"
                                                         class="w-12 h-12 rounded-xl object-cover border border-gray-200 dark:border-gray-700 flex-shrink-0">
                                                @else
                                                    <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center flex-shrink-0 border border-indigo-100 dark:border-indigo-900/40">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="min-w-0 max-w-md">
                                                    <p class="font-bold text-gray-900 dark:text-white truncate">
                                                        {{ $post->title }}
                                                    </p>
                                                    <p class="text-xs text-gray-400 dark:text-gray-500 font-mono truncate">
                                                        /posts/{{ $post->slug }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Category -->
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <x-badge :color="$post->category->color">
                                                {{ $post->category->name }}
                                            </x-badge>
                                        </td>

                                        <!-- Published Date -->
                                        <td class="py-4 px-6 whitespace-nowrap text-xs text-gray-500 dark:text-gray-400">
                                            {{ $post->created_at->format('M d, Y') }}
                                            <span class="block text-[11px] text-gray-400 dark:text-gray-500">
                                                {{ $post->created_at->diffForHumans() }}
                                            </span>
                                        </td>

                                        <!-- Actions -->
                                        <td class="py-4 px-6 text-right whitespace-nowrap">
                                            <div class="inline-flex items-center gap-1.5">
                                                <!-- View Live -->
                                                <a href="{{ route('posts.show', $post) }}"
                                                   target="_blank"
                                                   title="View public article"
                                                   class="p-2 rounded-lg text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-950/50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                    </svg>
                                                </a>

                                                <!-- Edit Post -->
                                                <a href="{{ route('dashboard.posts.edit', $post) }}"
                                                   title="Edit article"
                                                   class="p-2 rounded-lg text-gray-400 hover:text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-950/50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>

                                                <!-- Delete (Triggers Alpine.js Modal) -->
                                                <button @click="confirmDelete('{{ route('dashboard.posts.destroy', $post) }}', '{{ addslashes($post->title) }}')"
                                                        type="button"
                                                        title="Delete article"
                                                        class="p-2 rounded-lg text-gray-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-6 border-t border-gray-100 dark:border-gray-700/80">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="text-center py-16 px-4">
                        <div class="w-16 h-16 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 mx-auto flex items-center justify-center mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <h4 class="text-base font-bold text-gray-900 dark:text-white">You haven't written any articles yet</h4>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 max-w-sm mx-auto">
                            Share your thoughts, engineering tutorials, or software insights with the community.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('dashboard.posts.create') }}"
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold bg-indigo-600 hover:bg-indigo-700 text-white shadow-sm transition-colors">
                                Write First Article
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Alpine.js Delete Confirmation Modal -->
            <div x-show="showDeleteModal"
                 style="display: none;"
                 class="fixed inset-0 z-50 overflow-y-auto"
                 aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <!-- Backdrop with blur -->
                <div x-show="showDeleteModal"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="showDeleteModal = false"
                     class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"></div>

                <!-- Modal Panel -->
                <div class="min-h-full flex items-center justify-center p-4 text-center">
                    <div x-show="showDeleteModal"
                         x-transition:enter="ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                         x-transition:leave="ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                         class="relative transform overflow-hidden rounded-3xl bg-white dark:bg-gray-800 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-100 dark:border-gray-700 p-6 sm:p-8">
                        
                        <div class="sm:flex sm:items-start gap-4">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-rose-100 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 sm:mx-0">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:text-left flex-1">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white" id="modal-title">
                                    Delete Article
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                                        Are you sure you want to permanently delete <strong class="text-gray-900 dark:text-white" x-text="'&ldquo;' + postTitle + '&rdquo;'"></strong>? This action cannot be undone and will delete any uploaded featured images from storage.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Actions -->
                        <div class="mt-6 sm:flex sm:flex-row-reverse gap-3">
                            <form :action="deleteUrl" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex w-full justify-center rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-rose-500 sm:w-auto transition-colors">
                                    Yes, Delete Article
                                </button>
                            </form>
                            <button @click="showDeleteModal = false"
                                    type="button"
                                    class="mt-3 inline-flex w-full justify-center rounded-xl bg-white dark:bg-gray-700 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-650 sm:mt-0 sm:w-auto transition-colors">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
