<!-- Name -->
<div>
    <x-input-label for="name" :value="__('Nama Lengkap')" />
    <x-text-input id="name"
        class="block mt-1 w-full"
        type="text"
        name="name"
        :value="old('name')"
        required
        autofocus />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<!-- Nickname -->
<div class="mt-4">
    <x-input-label for="nickname" :value="__('Nama Panggilan')" />
    <x-text-input id="nickname"
        class="block mt-1 w-full"
        type="text"
        name="nickname"
        :value="old('nickname')"
        required />
    <x-input-error :messages="$errors->get('nickname')" class="mt-2" />
</div>

<!-- Email -->
<div class="mt-4">
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email"
        class="block mt-1 w-full"
        type="email"
        name="email"
        :value="old('email')"
        required />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Phone -->
<div class="mt-4">
    <x-input-label for="phone" :value="__('Nomor Telepon')" />
    <x-text-input id="phone"
        class="block mt-1 w-full"
        type="text"
        name="phone"
        :value="old('phone')"
        required />
    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />

    <x-text-input id="password"
        class="block mt-1 w-full"
        type="password"
        name="password"
        required />

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Confirm Password -->
<div class="mt-4">
    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

    <x-text-input id="password_confirmation"
        class="block mt-1 w-full"
        type="password"
        name="password_confirmation"
        required />

    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>