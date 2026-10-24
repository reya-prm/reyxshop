<div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-5 p-4">
    @foreach($this->getStats() as $key => $value)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 text-center">
            <div class="text-lg font-semibold capitalize">
                {{ str_replace('_', ' ', $key) }}
            </div>
            <div class="text-2xl font-bold mt-2">
                {{ $value }}
            </div>
        </div>
    @endforeach
</div>
