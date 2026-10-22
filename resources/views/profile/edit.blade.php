<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Author Profile & Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }"
                     x-init="setTimeout(() => show = false, 4000)"
                     x-show="show"
                     x-transition
                     class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-sm font-semibold">
                    Profile successfully updated!
                </div>
            @endif

            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-3xl border border-gray-200/80 dark:border-gray-700/80">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                Profile Information
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Update your account name, author username, and email address.
                            </p>
                        </header>

                        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Full Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <!-- Username -->
                            <div>
                                <x-input-label for="username" :value="__('Username')" />
                                <div class="relative mt-1">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400 text-sm">@</span>
                                    <x-text-input id="username" name="username" type="text" class="block w-full pl-8" :value="old('username', $user->username)" required autocomplete="username" />
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Used for author filtering: ?author={{ $user->username }}</p>
                                <x-input-error class="mt-2" :messages="$errors->get('username')" />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email Address')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-3xl border border-gray-200/80 dark:border-gray-700/80">
                <div class="max-w-xl">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-lg font-bold text-rose-600 dark:text-rose-400">
                                Delete Account
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Once your account is deleted, all resources and articles will be permanently removed.
                            </p>
                        </header>

                        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                            @csrf
                            @method('delete')

                            <div>
                                <x-input-label for="password" value="{{ __('Confirm Password to Delete') }}" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" placeholder="••••••••" required />
                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                            </div>

                            <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-xs font-semibold uppercase tracking-wider transition-colors">
                                Delete Account
                            </button>
                        </form>
                    </section>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
