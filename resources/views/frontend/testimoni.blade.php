@extends('layouts.frontend')

@section('title', 'Testimoni Klien - CMS BK')

@section('content')
    <div class="bg-indigo-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white">Testimoni Klien</h1>
            <p class="mt-4 text-indigo-100 max-w-2xl mx-auto">Kisah sukses dan pengalaman nyata dari mereka yang telah mempercayakan perjalanannya kepada kami.</p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8">
                @forelse ($testimonis as $testi)
                    <div class="break-inside-avoid bg-gray-50 p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col">
                        <div class="flex text-yellow-400 mb-4">
                            @for ($i = 0; $i < $testi->rating; $i++)
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                        <p class="text-gray-700 italic leading-relaxed mb-8">"{{ $testi->isi_testimoni }}"</p>
                        <div class="flex items-center mt-auto pt-6 border-t border-gray-200">
                            <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center font-bold text-white text-lg">
                                {{ substr($testi->nama, 0, 1) }}
                            </div>
                            <div class="ms-4">
                                <p class="font-bold text-gray-900">{{ $testi->nama }}</p>
                                <p class="text-gray-500 text-sm">{{ $testi->pekerjaan }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">Belum ada testimoni yang ditampilkan.</div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
