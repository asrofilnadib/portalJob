<x-mail::message>

  Congratulations, <em>{{ $name }}</em><br>
  You have been shortlisted for a job <strong>{{ $title }}</strong>. Please be ready for the interview

  Best Regards,<br>
  {{ config('app.name') }}
</x-mail::message>
