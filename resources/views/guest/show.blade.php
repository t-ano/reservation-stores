<x-guest-layout>

    <div>
        <div class="w-full sm:px-6 lg:px-20 bg-gradient-to-r from-green-100 to-green-400">
            <div class="overflow-hidden shadow-sm">
                <div class="p-6">
                    <h1 class="text-2xl text-gray-500   ">予約ページ</h1>
                </div>
            </div>
        </div>

        <div class="max-w-7xl w-4/5 mx-auto mb-20 sm:px-6 lg:px-8">

            <div class="mt-5">
                <span>予約が完了しました。予約内容は以下の通りです。</span>
            </div>

            <div class="px-6 pt-3">
                <x-label class="font-bold mt-5">氏名</x-label>
                <span class="px-5">{{ $customer->c_name }}</span>
                <x-label class="font-bold mt-5">メールアドレス</x-label>
                <span class="px-5">{{ $customer->c_mail }}</span>
                <x-label class="font-bold mt-5">予約店舗</x-label>
                <span class="px-5">{{ $reserve->s_name }}</span>
                <x-label class="font-bold mt-5">予約プラン</x-label>
                <span class="px-5">{{ $reserve->p_name }}</span>
                <x-label class="font-bold mt-5">お支払い</x-label>
                <span class="px-5">{{ number_format($reserve->price) }} 円</span>
            </div>

            @if ($reserve->payment)
                <div class="p-5 text-sm">支払い済み</div>
                <div class="mt-10">
            @else
                    <form id="payment-form" class="mt-5 border rounded shadow-sm" style="width:300px;">
                        <div id="card-element" class="p-5">
                            <!--Stripe.js injects the Card Element-->
                        </div>
                        <button id="submit" class="block w-full py-3 m-0 bg-green-300 text-gray-500 hover:bg-green-400 hover:text-white rounded">
                            <div class="spinner hidden" id="spinner"></div>
                            <span id="button-text">支払う</span>
                        </button>
                    </form>
                    <p id="card-error" role="alert"></p>
                    <p class="result-message hidden">
                        支払いが完了しました。
                    </p>
                </div>
            @endif

        </div>

    </div>

    <script>
        var price = {{ $reserve->price }};
        var reserveId = {{ $reserve->id }};
        var stripe = Stripe("{{ env('STRIPE_KEY') }}");
    </script>

</x-guest-layout>
