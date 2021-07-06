<x-guest-layout>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <h1 class="text-2xl">予約ページ</h1>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-6 pt-5 sm:w-4/5 lg:2/3">
                <x-label>店舗選択</x-label>
                <div class="mt-2">
                    @foreach ($shops as $shop)
                        <x-radio :name="'shop'" :value="$shop->id">{{ $shop->name }}</x-radio>
                    @endforeach
                </div>
            </div>

            <div class="px-6 pt-5">
                <x-label>プラン選択</x-label>
                
            </div>
        </div>

    </div>

</x-guest-layout>
