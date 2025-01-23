<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Purchase;
use App\Notifications\InformAuthorOfPurchase;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class PurchaseController extends Controller
{
    public function preparePayment(string $slug, int $amount, Request $request)
    {
        $article = Article::where('slug', $slug)->sole();

        $amount_in_cents = round($amount * 100);

        $dev_webhook_url = "https://ydnrmnzuks.sharedwithexpose.com/api/purchases/webhooks/mollie";

        $purchase = Purchase::create([
            'article_id' => $article->id,
            'user_id' => auth()->user()->id,
            'status' => 'pending',
            'price_in_cents' => $amount_in_cents,
        ]);

        ray((string) ($amount_in_cents/100));

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => number_format($amount_in_cents/100,2),
            ],
            "description" => "Purchase #".$purchase->id,
            "redirectUrl" => route('purchase.success', ['purchase' => $purchase]),
            "webhookUrl" => config('app.env') === 'production' ? route('webhooks.mollie') : $dev_webhook_url,
            "metadata" => [
                "purchase_id" => $purchase->id,
                "author_id" => $article->author_id,
                "title" => $article->title,
            ],
        ]);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function successfulPayment(Purchase $purchase)
    {
        session()->flash('purchase_id', $purchase->id);

        return redirect()->route('articles.show', ['slug' => $purchase->article->slug]);
    }

    public function webhook(Request $request)
    {
        $payment_id = $request->input('id');
        $payment = Mollie::api()->payments->get($payment_id);

        $purchase = Purchase::find($payment->metadata->purchase_id);
        $purchase->update([
            'payment_id' => $payment_id,
            'status' => $payment->status,
        ]);

        if($purchase->status === 'paid') {
            $purchase->article->author->notify(new InformAuthorOfPurchase($purchase));
        } else {
            //$purchase->user->notify(new WeAreWaitingForYourPayment($purchase));
        }

        ray($payment);
    }
}
