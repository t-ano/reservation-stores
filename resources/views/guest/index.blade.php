<x-guest-layout>

    <div>
        <div class="w-full sm:px-6 lg:px-20 bg-gradient-to-r from-green-100 to-green-400">
            <div class="overflow-hidden shadow-sm">
                <div class="p-6">
                    <h1 class="text-2xl text-gray-500   ">予約ページ</h1>
                </div>
            </div>
        </div>

        <div class="max-w-4xl w-4/5 mx-auto mb-20 sm:px-6 lg:px-8">

            <form action="{{ route('guest.index') }}" method="get">
                @csrf
                <div class="md:flex justify-start items-end mt-10 mb-5 ">
                    <div class="lg:w-1/4 mr-3">
                        <x-label>店舗名</x-label>
                        <x-input type="text" name="word" value="{{ $word }}" />                            
                    </div>
                    <div class="lg:w-1/4 mr-3">
                        <x-label>対象月</x-label>
                        <x-input name="month" type="month" value="{{ $month }}" />
                    </div>
                    <div class="mt-3 md:mt-0">
                        <x-grn-btn type="submit" name="search" value="絞り込み" />
                    </div>
                </div>
            </form>

            @if ($errors->any())
                <div class="text-red-400">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('guest.create') }}" method="get">
                @csrf

                <div class="px-6 pt-5" style="width:700px;">
                    <x-label class="text-lg font-bold">店舗選択</x-label>
                    <div class="mt-2 mx-5">
                        @foreach ($shops as $shop)
                            <x-radio :name="'shop'" :value="$shop->id" :checked="($shop->id == old('shop') || $shop->id == $selectedShop)">{{ $shop->name }}</x-radio>
                        @endforeach
                    </div>
                </div>

                <div class="px-6 pt-5">
                    <x-label class="text-lg font-bold">プラン選択</x-label>
                    <div class="mt-2">
                        <div class="w-full mx-auto px-5 overflow-x-auto shadow-sm">
                            <table class="text-center border-collapse" style="width:600px;">
                                <tr class="text-sm border-b border-gray-light text-left">
                                    <th>プラン名</th>
                                    <th>期間</th>
                                    <th>料金</th>
                                </tr>
                                @foreach ($plans as $plan)
                                    <tr class="text-left">
                                        <td><x-radio :name="'plan'" :value="$plan->id" :checked="($plan->id == old('plan') || $plan->id == $selectedPlan)">{{ $plan->name }}</x-radio></td>
                                        <td>{{ str_replace('-', '/', $plan->start) }} 〜 {{ str_replace('-', '/',$plan->end) }}</td>
                                        <td class="text-right">{{ number_format($plan->price) }} 円</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <x-grn-btn type="submit" value="予約する" />
                </div>

            </form>

        </div>

    </div>

</x-guest-layout>
