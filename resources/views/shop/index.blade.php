<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            店舗一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="h-100 w-full flex items-center justify-center bg-teal-lightest font-sans">
                        <div class="bg-white rounded shadow p-6 m-4 w-full md:w-3/4 lg:max-w-lg">
                            <div class="mb-4">
                                <div class="flex justify-end">
                                    <a href="{{ route('shop.create') }}" class="flex-no-shrink px-2 py-1 border-2 border-gray-400 font-bold text-gray-400 rounded hover:bg-green-400 hover:border-green-400 hover:text-white">新規追加</a>
                                </div>
                            </div>
                            <div>
                                @foreach ($shops as $shop)
                                <div class="flex mb-4 items-center">
                                    <p class="w-full text-grey-darkest">{{ $shop->shop_name }}</p>
                                    <a href="{{ route('shop.edit', ['id' => $shop->id]) }}" class="flex-no-shrink px-2 py-1 mx-3 border-2 border-gray-400 font-bold text-gray-400 rounded hover:bg-green-400 hover:border-green-400 hover:text-white whitespace-nowrap">編集</a>
                                    <button class="flex-no-shrink px-2 py-1 mx-3 border-2 border-gray-400 font-bold text-gray-400 rounded hover:bg-green-400 hover:border-green-400 hover:text-white whitespace-nowrap">削除</button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
