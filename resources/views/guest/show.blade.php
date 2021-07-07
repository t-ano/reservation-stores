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

            {{-- <form action="{{ route('guest.index') }}" method="get">
                @csrf --}}

            <div class="mt-5">
                <span>予約が完了しました。予約内容は以下の通りです。</span>
            </div>

            <div class="px-6 pt-3">
                <x-label class="font-bold mt-5">氏名</x-label>
                <span class="px-5">{{ $customer->name }}</span>
                <x-label class="font-bold mt-5">メールアドレス</x-label>
                <span class="px-5">{{ $customer->mail }}</span>
                <x-label class="font-bold mt-5">予約店舗</x-label>
                <span class="px-5">{{ $reserve->s_name }}</span>
                <x-label class="font-bold mt-5">予約プラン</x-label>
                <span class="px-5">{{ $reserve->p_name }}</span>
                <x-label class="font-bold mt-5">お支払い</x-label>
                <span class="px-5">{{ number_format($reserve->price) }} 円</span>
            </div>

            {{-- <div class="mt-10">
                    <x-grn-btn type="submit" value="決済に進む" />
                </div> --}}

            <div class="mt-10">
                <form id="payment-form" class="border rounded p-3 shadow-sm w-80">
                    <div id="card-element">
                        <!--Stripe.js injects the Card Element-->
                    </div>
                    <button id="submit">
                        <div class="spinner hidden" id="spinner"></div>
                        <span id="button-text">支払う</span>
                    </button>
                    <p id="card-error" role="alert"></p>
                    <p class="result-message hidden">
                        Payment succeeded, see the result in your
                        <a href="" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
                    </p>
                </form>
            </div>

            {{-- </form> --}}

        </div>

    </div>

    <script>
        // A reference to Stripe.js initialized with a fake API key.
        // Sign in to see examples pre-filled with your key.
        // var stripe = Stripe("pk_test_TYooMQauvdEDq54NiTphI7jx");
        var stripe = Stripe("{{ env('STRIPE_KEY') }}");
        // The items the customer wants to buy
        var purchase = {
            items: [{
                id: "xl-tshirt"
            }]
        };
        // Disable the button until we have Stripe set up on the page
        document.querySelector("button").disabled = true;
        fetch("{{ route('guest.pay') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].content,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(purchase)
            })
            .then(function(result) {
                return result.json();
            })
            .then(function(data) {
                var elements = stripe.elements();
                /*var style = {
                    base: {
                        color: "#32325d",
                        fontFamily: 'Arial, sans-serif',
                        fontSmoothing: "antialiased",
                        fontSize: "16px",
                        "::placeholder": {
                            color: "#32325d"
                        }
                    },
                    invalid: {
                        fontFamily: 'Arial, sans-serif',
                        color: "#fa755a",
                        iconColor: "#fa755a"
                    }
                };*/
                var card = elements.create("card", {
                    // style: style
                });
                // Stripe injects an iframe into the DOM
                card.mount("#card-element");
                card.on("change", function(event) {
                    // Disable the Pay button if there are no card details in the Element
                    document.querySelector("button").disabled = event.empty;
                    document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
                });
                var form = document.getElementById("payment-form");
                form.addEventListener("submit", function(event) {
                    event.preventDefault();
                    // Complete payment when the submit button is clicked
                    payWithCard(stripe, card, data.clientSecret);
                });
            });
    </script>

</x-guest-layout>
