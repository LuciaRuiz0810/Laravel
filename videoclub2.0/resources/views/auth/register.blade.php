@extends('layouts.master')
@section('content')
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 p-3 rounded bg-blue-50 text-blue-700 text-sm" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre completo')" />
            <x-text-input id="name" class="block mt-1 w-full px-3 py-2" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name"
                placeholder="Ingresa tu nombre" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full px-3 py-2" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autocomplete="email"
                placeholder="ejemplo@correo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full px-3 py-2"
                            type="password"
                            name="password"
                            required 
                            autocomplete="new-password"
                            placeholder="Mínimo 8 caracteres" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full px-3 py-2"
                            type="password"
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            placeholder="Repite tu contraseña" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms -->
        <div class="block">
            <label for="terms" class="inline-flex items-start">
                <input id="terms" 
                       type="checkbox" 
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 mt-1"
                       name="terms" 
                       required>
                <span class="ms-2 text-sm text-gray-600">
                    {{ __('Acepto los') }}
                    <a href="#" class="text-indigo-600 hover:text-indigo-900 font-medium">{{ __('términos del servicio') }}</a>
                    {{ __('y la') }}
                    <a href="#" class="text-indigo-600 hover:text-indigo-900 font-medium">{{ __('política de privacidad') }}</a>
                </span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
            <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150" href="{{ route('login') }}">
                {{ __('¿Ya tienes una cuenta?') }}
            </a>

            <x-primary-button class="px-6 py-2">
                {{ __('Crear cuenta') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@stop