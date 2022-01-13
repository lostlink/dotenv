<div class="container mx-auto space-y-4 p-4 sm:p-0">
    {{--    <ul class="flex flex-col sm:flex-row sm:space-x-8 sm:items-center">--}}
    {{--        <li>--}}
    {{--            <input type="checkbox" value="travel" wire:model="types"/>--}}
    {{--            <span>Travel</span>--}}
    {{--        </li>--}}
    {{--        <li>--}}
    {{--            <input type="checkbox" value="shopping" wire:model="types"/>--}}
    {{--            <span>Shopping</span>--}}
    {{--        </li>--}}
    {{--        <li>--}}
    {{--            <input type="checkbox" value="food" wire:model="types"/>--}}
    {{--            <span>Food</span>--}}
    {{--        </li>--}}
    {{--        <li>--}}
    {{--            <input type="checkbox" value="entertainment" wire:model="types"/>--}}
    {{--            <span>Entertainment</span>--}}
    {{--        </li>--}}
    {{--        <li>--}}
    {{--            <input type="checkbox" value="other" wire:model="types"/>--}}
    {{--            <span>Other</span>--}}
    {{--        </li>--}}
    {{--    </ul>--}}
    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
        @if($columnChartModel->data->pluck('value')->sum() === 0)
            <div class="relative block w-full border-2 border-gray-300 border-dashed rounded-lg p-12 text-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <x-heroicon-o-presentation-chart-bar class="mx-auto h-12 w-12 text-gray-400"/>
                <span class="mt-2 block text-sm font-medium text-gray-900">
                    There's been no Activity, you should do something!
                </span>
            </div>
        @else
            <div class="shadow rounded p-4 border bg-white flex-1" style="height: 32rem;">
                <livewire:livewire-column-chart
                    key="{{ $columnChartModel->reactiveKey() }}"
                    :column-chart-model="$columnChartModel"
                />
            </div>
        @endif
    </div>
</div>
