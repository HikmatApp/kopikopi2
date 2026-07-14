@props(['label', 'value', 'icon' => '📊', 'iconBg' => 'bg-orange-100', 'accent' => null])
<div @class(['bg-white rounded-2xl shadow-sm border p-5', $accent ? "border-l-4 border-l-$accent border-gray-100" : 'border-gray-100'])>
    <div class="flex items-center justify-between">
        <div class="min-w-0">
            <p class="text-sm text-gray-500 truncate">{{ $label }}</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $value }}</h3>
        </div>
        <div class="{{ $iconBg }} w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0 ml-3">
            {{ $icon }}
        </div>
    </div>
</div>
