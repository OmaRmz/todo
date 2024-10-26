<div class="container content py-6 mx-auto">
    <div class="div">
        <div class="hover:shadow p-5 bg-white border-2">
            <div>
                <form>
                    <div class="mb-5">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input wire:model="title" id="title" name="title" type="text" class="mt-1 block w-full"/>
                        @error('title')
                            <span class="text-red-500 text-xs mt-4 block ">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <x-input-label for="description" :value="__('Description')" />
                        <x-text-input wire:model="description" id="description" name="description" type="text" class="mt-1 block w-full"/>
                        @error('description')
                            <span class="text-red-500 text-xs mt-4 block ">{{ $message }}</span>
                        @enderror
                    </div>

                    <button wire:click.prevent="create" type="submit" 
                        class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Create
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
@if (session('success'))
    <span class="text-green-600 text-xs">{{ session('success') }}</span>
@endif