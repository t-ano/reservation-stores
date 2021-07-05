<button  {!! $attributes->merge(['type' => $type ?? '', 'class' => "border-2 border-green-400 font-bold text-green-400 px-4 py-1 transition duration-300 ease-in-out hover:bg-green-400 hover:text-white mr-6 rounded"]) !!}>
    {{ $slot }}
</button>