@props(['data'])
@slots(['image', 'name', 'sku', 'options', 'quantity', 'price', 'subtotal'])

<div {{ $attributes->twMerge('flex space-x-6 py-6') }}>
    <div class="flex size-20 shrink-0 bg-muted rounded">
        {{ $image }}
    </div>
    <div class="flex flex-col">
        <div class="flex flex-col">
            <strong>{{ $name }}</strong>
            <span class="text-muted text-sm">{{ $sku }}</span>
        </div>
        {{ $options }}
        <div class="mt-3 flex flex-1 items-end lg:mt-4">
            <dl class="flex flex-wrap divide-x text-sm">
                <div class="flex pr-2">
                    <dt class="font-bold">@lang('Quantity'):</dt>
                    <dd class="ml-1">{{ $quantity }}</dd>
                </div>
                <div class="flex px-2">
                    <dt class="font-bold">@lang('Price'):</dt>
                    <dd class="ml-1">{{ $price }}</dd>
                </div>
                <div class="flex pl-2">
                    <dt class="font-bold">@lang('Subtotal'):</dt>
                    <dd class="ml-1">{{ $subtotal }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>