<x-guest-layout>

    <div>
        <div class="w-full sm:px-6 lg:px-20 bg-gradient-to-r from-green-100 to-green-400">
            <div class="overflow-hidden shadow-sm">
                <div class="p-6">
                    <h1 class="text-2xl text-gray-500">予約ページ</h1>
                </div>
            </div>
        </div>

        <div class="max-w-7xl w-4/5 mx-auto mb-20 sm:px-6 lg:px-8">
            <form action="{{ route('guest.store') }}" method="post">
                @csrf

                <input type="hidden" name="shop" value="{{ $shop->id }}" />
                <input type="hidden" name="plan" value="{{ $plan->id }}" />

                <div class="px-6 pt-5 sm:w-4/5 lg:2/3">
                    <x-label class="text-lg font-bold">店舗</x-label>
                    <div class="mt-2 mx-5">
                        {{ $shop->name }}
                    </div>
                </div>

                <div class="px-6 pt-5">
                    <x-label class="text-lg font-bold">プラン</x-label>
                    <div class="mt-2">
                        <div class="w-full mx-auto px-5 overflow-x-auto shadow-sm">
                            <table class="text-center w-full border-collapse">
                                <tr class="text-sm border-b border-gray-light text-left">
                                    <th>プラン名</th>
                                    <th>期間</th>
                                    <th>料金</th>
                                </tr>
                                <tr class="text-left">
                                    <td>{{ $plan->name }}</td>
                                    <td>{{ str_replace('-', '/', $plan->start) }} 〜 {{ str_replace('-', '/',$plan->end) }}</td>
                                    <td>{{ $plan->price }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="px-6 pt-10">
                    <div class="mb-3">以下の項目を入力してください。</div>
                    <x-label class="font-bold mt-3">お名前</x-label>
                    <x-input type="text" name="name" value="" required />
                    <x-label class="font-bold mt-3">メールアドレス</x-label>
                    <x-input type="text" name="mail" value="" required />
                </div>
          
                @if ($errors->any())
                    <div class="text-red-400 mt-5">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mt-7 px-6">
                    <x-grn-btn type="submit" value="確定する" />
                    <a href="{{ route('guest.index', ['selectedShop' => $shop, 'selectedPlan' => $plan]) }}"><x-grn-btn type="button" value="戻る" /></a>
                </div>

            </form>
        </div>
    </div>

</x-guest-layout>
