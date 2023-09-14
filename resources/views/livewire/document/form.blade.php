<form wire:submit.prevent="{{$action}}">
    <div class=" p-6">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="title" value="{{ __('Title') }}"/>
            <x-input id="title" type="text" name="title" class="mt-1 block w-full" wire:model="title" required
                     autocomplete="title"/>
            <x-input-error for="title" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4 mt-3">
            <label for="content">{{ __('Content') }}</label>
            <textarea id="content" type="text"
                      class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                      wire:model="content" required
                      name="content"
                      autocomplete="content"></textarea>
            <x-input-error for="content" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-label for="title" value="{{ __('Signing') }}"/>
            <input id="signing" type="file" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" wire:model="signingPhoto" required
                     autocomplete="signing" name="singing" accept="image/png"/>
            <x-input-error for="signing" class="mt-2"/>
            @if($action=="update")
                <img src="{{ asset('storage/'.$signing) }}" alt="">
            @endif
        </div>

        <button type='submit'
                class='mt-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>
            Submit
        </button>
    </div>
</form>
