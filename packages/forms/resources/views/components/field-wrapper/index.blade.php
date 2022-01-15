@props([
    'id',
    'label' => null,
    'labelPrefix' => null,
    'labelSrOnly' => false,
    'labelSuffix' => null,
    'helperText' => null,
    'hint' => null,
    'hintIcon' => null,
    'required' => false,
    'statePath',
])

<div {{ $attributes }}>
    @if ($label && $labelSrOnly)
        <label for="{{ $id }}" class="sr-only">
            {{ $label }}
        </label>
    @endif

    <div class="space-y-2">
        @if (($label && ! $labelSrOnly) || $hint)
            <div class="flex items-center justify-between space-x-2 rtl:space-x-reverse">
                @if ($label && ! $labelSrOnly)
                    <x-forms::field-wrapper.label
                        :for="$id"
                        :error="$errors->has($statePath)"
                        :prefix="$labelPrefix"
                        :required="$required"
                        :suffix="$labelSuffix"
                        class="flex-1"
                    >
                        {{ $label }}
                    </x-forms::field-wrapper.label>
                @endif

                @if ($hint)
                    <x-forms::field-wrapper.hint>
                        {!! \Illuminate\Support\Str::markdown($hint) !!}
                    </x-forms::field-wrapper.hint>
                @endif

                @if ($hintIcon)
                    <x-dynamic-component :component="$hintIcon" class="h-4 w-4 ml-2 rtl:mr-2 text-gray-500" />
                @endif
            </div>
        @endif

        {{ $slot }}

        @if ($errors->has($statePath))
            <x-forms::field-wrapper.error-message>
                {{ $errors->first($statePath) }}
            </x-forms::field-wrapper.error-message>
        @endif

        @if ($helperText)
            <x-forms::field-wrapper.helper-text>
                {!! \Illuminate\Support\Str::markdown($helperText) !!}
            </x-forms::field-wrapper.helper-text>
        @endif
    </div>
</div>
