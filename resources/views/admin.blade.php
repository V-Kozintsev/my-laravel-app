@extends('layouts.app')

@section('styles')
    @vite('resources/css/excel.css')
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg" style="padding:50px;">
        <h1 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">Загрузка Excel файла</h1>

        @if($errors->any())
            <div class="mb-4 text-sm text-red-600">{{ $errors->first() }}</div>
        @endif

        @if(session('success'))
            <div class="mb-4 text-sm text-green-600 flex gap-4 flex-wrap items-center">
                <span>Файл успешно обработан!</span>
                @if(session('filtered_file'))
                    <a href="{{ route('admin.filtered.download', ['name' => session('filtered_file')]) }}"
                       class="underline text-green-700 dark:text-green-400"
                       download>
                        Скачать обработанный файл
                    </a>
                @endif
            </div>
        @endif

        <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="file">
                    Выберите Excel файл (.xls, .xlsx)
                </label>
                <div class="flex items-center gap-4 mb-4">
                    <input id="file" name="file" type="file" accept=".xls,.xlsx" required
                        class="border border-gray-300 rounded bg-white dark:bg-gray-700 dark:text-gray-200 p-2 max-w-xs"
                        onchange="document.getElementById('file-name').textContent = this.files[0] ? this.files[0].name : 'Файл не выбран'">
                    <span id="file-name" class="text-gray-500 dark:text-gray-400 text-sm">Файл не выбран</span>
                </div>
            </div>

            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white py-2 px-5 rounded text-sm font-medium transition">
                Загрузить
            </button>
        </form>
    </div>
</div>
@endsection
