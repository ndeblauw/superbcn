<div class=" bg-zinc-400 text-zinc-500">
    <div class="max-w-7xl mx-auto p-8">
        <h2 class="font-semibold text-4xl text-teal-400 mb-8">Subscribe</h2>

        @if($message!==null)
            <div class="bg-green-500 text-green-50">
                {{$message}}
            </div>
        @endif

        <div class="flex">
            <div>
                <input wire:model="email" type="text" placeholder="your email please" class="@error('email') border-red-500 @enderror"/>
                @error('email') <div class="text-red-500">wrong email address</div> @enderror
            </div>
            <button wire:click="submitEmail()" type="submit">Subscribe</button>
        </div>


</div>
</div>
