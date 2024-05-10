<?php

namespace App\Http\Controllers;

use App\Http\Middleware\isEmployer;
use App\Mail\PurchaseMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use MongoDB\Driver\Session;
use mysql_xdevapi\Exception;
use Stripe\Stripe;
use function Laravel\Prompts\select;

class SubscriptionController extends Controller
{
  const weekly_amount = 20;
  const weekly_monthly = 80;
  const weekly_yearly = 200;
  const current_currency = 'USD';

  public function index()
  {
    return view('subscribe.index');
  }

  public function initiatePayments(Request $request)
  {
    $plans = [
      'weekly' => [
        'name' => 'weekly',
        'description' => 'weekly payments',
        'amount' => self::weekly_amount,
        'currency' => self::current_currency,
        'quantity' => 1
      ],
      'monthly' => [
        'name' => 'monthly',
        'description' => 'monthly payments',
        'amount' => self::weekly_monthly,
        'currency' => self::current_currency,
        'quantity' => 1
      ],
      'yearly' => [
        'name' => 'yearly',
        'description' => 'yearly payments',
        'amount' => self::weekly_yearly,
        'currency' => self::current_currency,
        'quantity' => 1
      ]
    ];

//    Stripe::setApiKey(services.stripe.secret);
    try {
      $selectPlan = null;
      if ($request->is('/pay/weekly')) {
        $selectPlan = $plans['weekly'];
        $billingEnds = now()->addWeek()->startOfDay()->toDateString();
      } elseif ($request->is('/pay/month')) {
        $selectPlan = $plans['monthly'];
        $billingEnds = now()->addWeek()->startOfDay()->toDateString();
      } elseif ($request->is('/pay/yearly')) {
        $selectPlan = $plans['yearly'];
        $billingEnds = now()->addWeek()->startOfDay()->toDateString();
      }
      if ($selectPlan) {
        $successURL = URL::signedRoute('payment.success', [
          'plan' => $selectPlan['name'],
          'billingEnds' => $billingEnds,
        ]);

        $session = Session::create([
          'pay_method_type' => ['card'],
          'line_items' => [
            [
              'name' => $selectPlan['name'],
              'description' => $selectPlan['description'],
              'amount' => $selectPlan['amount']*100,
              'currency' => $selectPlan['currency'],
              'quantity' => $selectPlan['quantity'],
            ]
          ],
          'success_URL' => $successURL,
          'cancel_URL' => route('payment.cancel')
        ]);
        return redirect($session->url);
      }
    } catch (\Exception $e) {
      return json_encode($e);
    }
  }

  public function success(Request $request)
  {
    $plan = $request->plan;
    $billingEnds = $request->billing_ends;
    User::when('id', auth()->user()->id)->update([
      'plan' => $plan,
      'billingEnds' => $billingEnds,
      'status' => 'paid'
    ]);

    try {
      Mail::to($request->user()->auth())->queue(new PurchaseMail($plan, $billingEnds));
    } catch (\Exception $e) {
      return json_encode($e);
    }

    return redirect()->route('/dashboard')->with('success', 'Payment was successfully processed');
  }

  public function cancel()
  {
    return redirect()->route('/dashboard')->with('cancel', 'Payment was declined');
  }
}
