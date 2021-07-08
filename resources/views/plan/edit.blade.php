<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            店舗編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
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
                        <form action="{{ route('plan.update', ['id' => $plan->id]) }}" method="post">
                            @csrf

                            <div class="">
                                <x-label>予約プラン名称</x-label>
                                <x-input name="name" value="{{ $plan->name }}" type="text" required class="w-full" />
                            </div>
                            <div class="mt-3">
                                <x-label>料金</x-label>
                                <x-input name="price" value="{{ $plan->price }}" type="text" required class="w-4/5" />円
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