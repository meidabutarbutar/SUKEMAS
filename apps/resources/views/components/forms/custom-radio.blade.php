<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
    class="text-lg"
>

    <h3 class="mb-4 text-lg text-gray-900 dark:text-white">{{ $getLabel() }}</h3>
    <ul
        class="items-center w-8/12 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">

        @foreach ($getOptions() as $value => $label)
            <li class="w-full border-b border-gray-200 hover:bg-green-300 sm:border-b-0 sm:border-r dark:border-gray-600">
                <div class="flex items-center pl-3">
                    <input
                    name="{{ $getId() }}"
                    id="{{ $getId() }}-{{ $value }}"
                    type="radio"
                    value="{{ $value }}"
                    dusk="filament.forms.{{ $getStatePath() }}"
                    {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
                    {{ $getExtraInputAttributeBag()->class([
                        'peer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500',
                    ]) }}
                    wire:loading.attr="disabled"
                    />
                    <label for="{{ $getId() }}-{{ $value }}"
                    @class(["w-full py-3 ml-2 text-lg font-medium text-gray-900 peer-checked:font-black dark:text-gray-300"])>
                        {{ $label }}
                    </label>
                </div>
            </li>
        @endforeach
    </ul>
</x-dynamic-component>
