@if($team->hasSubscription())
<p>You've used {{ $team->users->count() }} out of {{ optional($team->plan)->team_limit ?? '0' }} available user slots.</p>
@endif