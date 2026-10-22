<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Article') }}: <span class="text-indigo-600 dark:text-indigo-400">{{ $post->title }}</span>
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('posts.show', $post) }}"
                   target="_blank"
                   class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700">
                    View Live &rarr;
                </a>
                <a href="{{ route('dashboard.posts.index') }}"
                   class="inline-flex items-center gap-1.5 text-xs font-semibold text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">
                    &larr; Back to Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-200/80 dark:border-gray-700/80 shadow-sm p-6 sm:p-10">
                
                <form method="POST"
                      action="{{ route('dashboard.posts.update', $post) }}"
                      enctype="multipart/form-data"
                      x-data="{
                          title: '{{ addslashes(old('title', $post->title)) }}',
                          slug: '{{ addslashes(old('slug', $post->slug)) }}',
                          generateSlug() {
                              this.slug = this.title
                                  .toLowerCase()
                                  .trim()
                                  .replace(/[^\w\s-]/g, '')
                                  .replace(/[\s_-]+/g, '-')
                                  .replace(/^-+|-+$/g, '');
                          }
                      }"
                      class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Title Input with Real-time Slug Auto-Generation -->
                    <div>
                        <x-input-label for="title" :value="__('Article Title')" />
                        <x-text-input id="title"
                                      class="block mt-1 w-full text-lg"
                                      type="text"
                                      name="title"
                                      x-model="title"
                                      @input="generateSlug()"
                                      required
                                      autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Slug Input (Auto-generated via Alpine.js) -->
                    <div>
                        <div class="flex items-center justify-between">
                            <x-input-label for="slug" :value="__('URL Slug')" />
                            <span class="text-xs text-gray-400">Unique URL path</span>
                        </div>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400 text-xs font-mono">
                                /posts/
                            </span>
                            <x-text-input id="slug"
                                          class="block w-full pl-16 font-mono text-sm"
                                          type="text"
                                          name="slug"
                                          x-model="slug"
                                          required />
                        </div>
                        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                    </div>

                    <!-- Category Selector -->
                    <div>
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select id="category_id"
                                name="category_id"
                                class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm text-sm"
                                required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }} ({{ ucfirst($category->color) }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <!-- Featured Image Upload with Alpine.js Live Preview -->
                    <div x-data="{
                            preview: null,
                            fileChosen(event) {
                                const file = event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => { this.preview = e.target.result; };
                                    reader.readAsDataURL(file);
                                } else {
                                    this.preview = null;
                                }
                            }
                         }">
                        <x-input-label for="image" :value="__('Featured Image')" />

                        <!-- Current Image Display if exists -->
                        @if($post->image)
                            <div class="mt-2 mb-3">
                                <p class="text-xs text-gray-500 mb-1">Current Image:</p>
                                <img src="{{ asset('storage/' . $post->image) }}"
                                     alt="Current post image"
                                     class="w-full max-h-56 object-cover rounded-2xl border border-gray-200 dark:border-gray-700">
                            </div>
                        @endif

                        <!-- Live Preview for newly selected file -->
                        <div x-show="preview" class="mt-3 mb-4 rounded-2xl overflow-hidden border border-indigo-300 dark:border-indigo-700 max-h-64 bg-gray-50" style="display: none;">
                            <p class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 p-2 bg-indigo-50 dark:bg-indigo-950/60">New Image Preview:</p>
                            <img :src="preview" alt="Image preview" class="w-full h-52 object-cover">
                        </div>

                        <div class="mt-1 flex items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-700 border-dashed rounded-2xl hover:border-indigo-400 dark:hover:border-indigo-600 transition-colors bg-gray-50/50 dark:bg-gray-900/50">
                            <div class="space-y-2 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400 justify-center">
                                    <label for="image" class="relative cursor-pointer rounded-md font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 focus-within:outline-none">
                                        <span>Upload a replacement image</span>
                                        <input id="image"
                                               name="image"
                                               type="file"
                                               accept="image/*"
                                               @change="fileChosen"
                                               class="sr-only">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Leave blank to keep existing image</p>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <!-- Body Content -->
                    <div>
                        <x-input-label for="body" :value="__('Article Content')" />
                        <textarea id="body"
                                  name="body"
                                  rows="12"
                                  class="mt-1 block w-full rounded-2xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm text-sm leading-relaxed"
                                  required>{{ old('body', $post->body) }}</textarea>
                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100 dark:border-gray-700/80">
                        <a href="{{ route('dashboard.posts.index') }}"
                           class="px-5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 text-sm font-semibold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors">
                            Cancel
                        </a>
                        <x-primary-button class="py-2.5 px-6">
                            {{ __('Save Changes') }}
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
