@if(!isset($label) || (isset($label) && $label))
    <label class="font-semibold" for="{{ $name }}">@lang($label ?? ucfirst($name))</label>
@endif
<input
    class="form-input w-full mb-3"
    type="text"
    id="{{ $name }}"
    v-model="changes.{{ $name }}"
    placeholder="@lang($label ?? ucfirst($name))"
>
