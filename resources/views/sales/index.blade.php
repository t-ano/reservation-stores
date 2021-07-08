<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            売上一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="w-full lg:w-2/3 mx-auto">
                        <form action={{ route('sales.change') }} method="post" class="flex justify-between">
                            @csrf
                            <div>
                                <x-label>日付指定</x-label>
                                <x-input type="date" name="date" value="{{ session('date') }}" />
                            </div>
                            <div>
                                <x-label>月指定</x-label>
                                <x-input type="month" name="month" value="{{ session('month') }}" />
                            </div>
                            <div>
                                <x-label>年指定</x-label>
                                <x-input type="text" name="year" size="5" placeholder="西暦4桁" value="{{ session('year') }}" />
                            </div>
                            <div class="mt-auto">
                                <x-grn-btn type="submit" name="change" value="表示切替" />
                            </div>
                            <div class="mt-auto">
                                <a href="{{ route('sales.download') }}"><x-grn-btn type="buttton" value="CSVダウンロード" /></a>
                            </div>
                        </form>
                        <div class="bg-white shadow-sm rounded my-6">
                            <div class="mb-3 px-3 text-lg border-b border-gray-300 w-52">合計金額：{{ number_format($result->total) }} 円</div>
                            <table class="text-center w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th
                                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                            売上金額（円）</th>
                                        <th
                                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                            売上日</th>
                                        <th
                                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                            予約店舗</th>
                                        <th
                                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-grey-dark border-b border-grey-light">
                                            予約プラン</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reserves as $reserve)
                                        <tr class="hover:bg-grey-lighter">
                                            <td class="py-4 px-6 border-b border-grey-light">{{ number_format($reserve->price) }}</td>
                                            <td class="py-4 px-6 border-b border-grey-light">{{ str_replace('-', '/', $reserve->r_dt) }}</td>
                                            <td class="py-4 px-6 border-b border-grey-light">{{ $reserve->s_name }}</td>
                                            <td class="py-4 px-6 border-b border-grey-light">{{ $reserve->p_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementsByName('date')[0].addEventListener('change', function() {
            document.getElementsByName('month')[0].value = '';
            document.getElementsByName('year')[0].value = '';
        });
        document.getElementsByName('month')[0].addEventListener('change', function() {
            document.getElementsByName('date')[0].value = '';
            document.getElementsByName('year')[0].value = '';
        });
        document.getElementsByName('year')[0].addEventListener('change', function() {
            document.getElementsByName('month')[0].value = '';
            document.getElementsByName('date')[0].value = '';
        });
    </script>

</x-app-layout>
