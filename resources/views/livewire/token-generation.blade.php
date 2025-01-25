<div class="bg-blue-100 p-4 my-4">
    <h2 class="font-bold">About our API (access) and your tokens</h2>
    @if(($tokens = auth()->user()->tokens)->isNotEmpty())
        @if($plain_text)
            <div class="border border-blue-400 p-2">
                You can use <strong>{{$plain_text}}</strong>
            </div>
        @endif

        Your token(s):<br/>
        @foreach($tokens as $token)
                - <strong>{{$token->name}}</strong> created on {{$token->created_at->toDateTimeString()}}
        @endforeach
    @else
        <button wire:click="generateToken" class="text-blue-800 bg-blue-300 hover:bg-blue-500 p-1 rounded uppercase">generate token</button>
    @endif
</div>
