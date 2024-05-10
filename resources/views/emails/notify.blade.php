<x-mail::message>
  # Introduction

  Congratulation! You are now a premium member.
  <p>Your purchase details:</p>
  <p>Plan: {{ $plan }}</p>
  <p>Billing Ends: {{ $billing_ends }}</p>
  <x-mail::button :url="''">
    Button Text
  </x-mail::button>

  Thanks,<br>
  {{ config('app.name') }}
</x-mail::message>
