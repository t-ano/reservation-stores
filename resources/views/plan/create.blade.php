<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            店舗登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="text-red-500">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="leading-loose m-3 p-5">
                        <form action="{{ route('plan.store') }}" method="post">
                            @csrf

                            <div>
                                <x-label>予約プラン名称</x-label>
                                <x-input name="name" value="{{ old('name') }}" type="text" required class="md:w-1/3" />
                            </div>
                            <div class="mt-3">
                                <x-label>料金</x-label>
                                <x-input name="price" value="{{ old('price') }}" type="text" required class="md:w-1/4" />円
                            </div>
                            <div class="mt-3">
                                <x-label>開始日</x-label>
                                <x-input name="start" value="{{ old('start') }}" type="date" required class="md:w-1/4" />
                            </div>
                            <div class="mt-3">
                                <x-label>終了日</x-label>
                                <x-input name="end" value="{{ old('end') }}" type="date" required class="md:w-1/4" />
                            </div>
                            <div class="mt-5">
                                <x-grn-btn type="submit" value="登録" />
                            </div>
                        </form>
                      </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
