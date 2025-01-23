<div>
    @if($purchase->status === 'paid')
        <div class="bg-green-100 p-4 my-4">
            Hurray, you paid {{$purchase->price_in_eur()}} for {{$purchase->article->title}}
        </div>
    @endif
    @if($purchase->status === 'pending')
        <div wire:poll.2s class="bg-yellow-100 p-4 my-4">
            Your purchase of {{$purchase->price_in_eur()}} for {{$purchase->article->title}} is pending
        </div>
    @endif

</div>
