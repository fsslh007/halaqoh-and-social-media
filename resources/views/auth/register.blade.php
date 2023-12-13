<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('images/app_logo/app-logo1.png') }}" alt="app logo" style="width: 350px; height: auto;">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="{{ __('First name') }}" />
                </div>
                
                <div>
                    <x-jet-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required placeholder="{{ __('Surname') }}" />
                </div>
            </div>

            <div class="mt-4">
                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required placeholder="{{ __('Username') }}" />
            </div>

            <div class="mt-4">
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="{{ __('Email address') }}" />
            </div>

            <div class="mt-4">
                <x-jet-label for="dob" value="{{ __('Date of Birth') }}" />
                <div class="flex items-center">
                    <select id="day" name="day" class="flex-1 mr-2 block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="" selected disabled>DD</option>
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                        @endfor
                    </select>

                    <select id="month" name="month" class="flex-1 mr-2 block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="" selected disabled>MM</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                        @endfor
                    </select>

                    <select id="year" name="year" class="flex-1 block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="" selected disabled>YYYY</option>
                        @for ($i = date('Y'); $i >= 1900; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <x-jet-label for="gender" value="{{ __('Gender') }}" />
                <div class="flex items-center mt-2">
                    <label for="male" class="flex-1 mr-2">
                        <div class="border rounded-md p-2 flex items-center justify-between cursor-pointer border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <span>Male</span>
                            <input type="radio" name="gender" value="male" class="" />
                        </div>
                    </label>

                    <label for="female" class="flex-1">
                        <div class="border rounded-md p-2 flex items-center justify-between cursor-pointer border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <span>Female</span>
                            <input type="radio" name="gender" value="female" class="" />
                        </div>
                    </label>
                </div>
            </div>

            <div class="mt-4">
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}" />
            </div>

            <div class="mt-4">
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
