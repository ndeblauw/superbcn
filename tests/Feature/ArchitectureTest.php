<?php

it('checks that no dd, dump (ray is allowed) statements are used', function () {
    expect(['dd', 'dump'])->not()->toBeUsed();
});

it('checks that interfaces are clean')
    ->arch('app')->expect("App\Services\Interfaces")
    ->toBeAbstract()
    ->toBeInterface();

it('checks that jobs are ran on the queue only')
    ->arch('app')->expect("App\Jobs")
    ->toImplement('Illuminate\Contracts\Queue\ShouldQueue');

it('checks that notifications are ran on the queue only')
    ->arch('app')->expect("App\Notifications")
    ->toImplement('Illuminate\Contracts\Queue\ShouldQueue')
    ->ignoring([App\Notifications\HelloNewUser::class]);
