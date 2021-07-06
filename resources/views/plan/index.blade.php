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

                    <div class="w-4/5 mx-auto overflow-x-auto">
                        <div class="bg-white shadow-sm rounded my-6" style="min-width:900px;">
                            <table class="text-center w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th
                                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                            予約プラン名称</th>
                                        <th
                                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                            料金</th>
                                        <th
                                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                            開始</th>
                                        <th
                                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                            終了</th>
                                        <th
                                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-grey-dark border-b border-grey-light">
                                            <a href="{{ route('plan.create') }}">
                                                <x-grn-btn value="新規作成" />
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plans as $plan)
                                    <tr class="hover:bg-grey-lighter">
                                        <td class="py-4 px-6 border-b border-grey-light">{{ $plan->name }}</td>
                                        <td class="py-4 px-6 border-b border-grey-light">{{ number_format($plan->price) }} 円</td>
                                        <td class="py-4 px-6 border-b border-grey-light">{{ str_replace('-', '/', $plan->start) }} </td>
                                        <td class="py-4 px-6 border-b border-grey-light">{{ str_replace('-', '/',$plan->end) }} </td>
                                        <td class="py-4 px-6 border-b border-grey-light">
                                            <form action="{{ route('plan.destroy', $plan->id) }}" method="post">
                                                @csrf
                                                <a href="{{ route('plan.edit', ['id' => $plan->id]) }}">
                                                    <x-grn-btn type="button" value="編集" />
                                                </a>
                                                <x-grn-btn type="submit" onclick="return deleteCheck()" value="削除" />
                                            </form>
                                        </td>
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
        function deleteCheck() {
            if (window.confirm('削除しますか？')) return true;
            return false;
        }
    </script>

</x-app-layout>