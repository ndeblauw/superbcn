<div class="bg-yellow-500 my-5 p-2 text-xl flex gap-6 items-center">
    <p>{{$counter}}</p>
    <button wire:click="increment()">+</button>
    <button wire:click="decrement()">-</button>

    <input wire:model.live="counter" type="text">
</div>
