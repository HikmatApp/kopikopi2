<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label', 'value', 'icon' => '📊', 'iconBg' => 'bg-orange-100', 'accent' => null]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['label', 'value', 'icon' => '📊', 'iconBg' => 'bg-orange-100', 'accent' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['bg-white rounded-2xl shadow-sm border p-5', $accent ? "border-l-4 border-l-$accent border-gray-100" : 'border-gray-100']); ?>">
    <div class="flex items-center justify-between">
        <div class="min-w-0">
            <p class="text-sm text-gray-500 truncate"><?php echo e($label); ?></p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1"><?php echo e($value); ?></h3>
        </div>
        <div class="<?php echo e($iconBg); ?> w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0 ml-3">
            <?php echo e($icon); ?>

        </div>
    </div>
</div>
<?php /**PATH C:\xampppp\htdocs\Kopikopi-lengkap (2)\Kopikopi-main\resources\views/components/stat-card.blade.php ENDPATH**/ ?>