@extends('layouts.frontend')

@section('title', 'Tentang Kami - ' . ($profil->judul ?? 'CMS BK'))

@section('content')
    <div class="bg-indigo-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white">Tentang Kami</h1>
            <p class="mt-4 text-indigo-100 max-w-2xl mx-auto">Kenali lebih dekat lembaga kami dan dedikasi kami dalam membantu Anda.</p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Profil Lembaga</h2>
                <div class="prose prose-indigo prose-lg text-gray-600 mx-auto whitespace-pre-wrap">
                    {{ $profil->profil ?? 'Informasi profil belum tersedia.' }}
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-white p-10 rounded-2xl shadow-sm border-t-4 border-indigo-600">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-8 h-8 text-indigo-600 me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        Visi
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed italic">
                        "{{ $profil->visi ?? 'Visi belum tersedia.' }}"
                    </p>
                </div>
                <div class="bg-white p-10 rounded-2xl shadow-sm border-t-4 border-indigo-600">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-8 h-8 text-indigo-600 me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Misi
                    </h2>
                    <div class="text-gray-600 leading-relaxed whitespace-pre-wrap">
                        {{ $profil->misi ?? 'Misi belum tersedia.' }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
