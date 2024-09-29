<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center px-4">
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-lg relative z-10">
        <form wire:submit.prevent="save" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" wire:model="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Amount</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">USD</span>
                    </div>
                    <input type="text" wire:model="amount" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="0.00">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <span class="text-gray-500 dark:text-gray-50 sm:text-sm" aria-hidden="true">.00</span>
                    </div>
                </div>
                <p class="mt-2 text-sm text-gray-500">It submits an unmasked value.</p>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" wire:click="dispatch('cancel')" class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</button>
                <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Click me!</button>
            </div>
        </form>
    </div>
</div>
