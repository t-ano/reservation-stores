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

                    <div class="leading-loose">
                        <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl">
                            <div class="">
                                <label class="block text-sm text-gray-00" for="cus_name">店舗名</label>
                                <input class="w-full px-5 py-1 text-gray-400 bg-gray-200 rounded" name="shop_name" type="text" required="">
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="flex-no-shrink px-2 py-1 mx-3 border-2 border-gray-400 font-bold text-gray-400 rounded hover:bg-green-400 hover:border-green-400 hover:text-white">登録</button>
                            </div>
                        </form>
                      </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
