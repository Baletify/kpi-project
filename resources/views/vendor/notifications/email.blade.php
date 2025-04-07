<x-mail::message>
{{-- Greeting --}}
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Ini adalah email otomatis yang berasal dari Aplikasi KPI')
@endif

{{-- Intro Lines --}}
Silahkan klik tombol di bawah ini untuk melakukan reset password.


{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
Link ini berlaku selama 60 menit. Jika Anda tidak melakukan reset password, maka link ini akan kadaluarsa.

{{-- Salutation --}}

@lang('Terima Kasih atas kerjasamanya')


{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
@lang(
    "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
