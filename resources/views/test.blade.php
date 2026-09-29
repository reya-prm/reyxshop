@extends('layouts.app')

@section('title', 'Setup Berhasil — ' . config('app.name'))

@section('content')
    <div class="mx-auto flex min-h-screen max-w-xl flex-col justify-center px-6 py-16">
        <p class="text-sm font-semibold uppercase tracking-widest text-brand-500">Tahap 1</p>
        <h1 class="mt-2 text-4xl font-extrabold tracking-tight">{{ config('app.name') }}</h1>
        <p class="mt-3 text-slate-600">Laravel, Blade, dan Tailwind CSS berjalan.</p>

        <div class="mt-8 rounded border border-slate-200 bg-white p-5 text-sm">
            <dl class="space-y-3">
                <div class="flex justify-between gap-4">
                    <dt class="text-slate-500">Laravel</dt>
                    <dd class="font-medium">{{ app()->version() }}</dd>
                </div>
                <div class="flex justify-between gap-4">
                    <dt class="text-slate-500">PHP</dt>
                    <dd class="font-medium">{{ PHP_VERSION }}</dd>
                </div>
                <div class="flex justify-between gap-4">
                    <dt class="text-slate-500">Database</dt>
                    <dd class="font-medium">{{ config('database.default') }}</dd>
                </div>
                <div class="flex justify-between gap-4">
                    <dt class="text-slate-500">Environment</dt>
                    <dd class="font-medium">{{ app()->environment() }}</dd>
                </div>
            </dl>
        </div>
    </div>
@endsection
