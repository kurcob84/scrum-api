{{-- Geschlecht --}}
@if ($user->salutation !== null)
    {{-- Vorname --}}
    @if ($user->firstname !== null && $user->surname == null)
        {{-- Hallo Max --}}
         {{ __('mail.salutation_private') }}{!! __('mail.title', ['name' => $user->firstname]) !!}
    {{-- Nachname --}}
    @elseif ($user->firstname == null && $user->surname !== null)
        {{-- Lieber Herr Mustermann --}}
        {!! trans_choice('mail.salutation', $user->salutation) !!}{!! __('mail.title', ['name' => $user->surname]) !!}
    {{-- Vorname & Nachname --}}
    @elseif ($user->firstname !== null && $user->surname != null)
        {{-- Lieber Herr Max Mustermann --}}
        {!! trans_choice('mail.salutation', $user->salutation) !!}{!! __('mail.title',  ['name' => $user->firstname . ' ' . $user->surname]) !!}
    @endif
{{-- Kein Geschlecht --}}
@elseif ($user->salutation == null)
    {{-- Vorname --}}
    @if ($user->firstname !== null && $user->surname == null)
        {{-- Hallo Max --}}
         {{ __('mail.salutation_private') }}{!! __('mail.title', ['name' => $user->firstname]) !!}
    {{-- Nachname --}}
    @elseif ($user->firstname == null && $user->surname !== null)
        {{-- Hallo Mustermann --}}
         {{ __('mail.salutation_private') }}{!! __('mail.title', ['name' => $user->surname]) !!}
    {{-- Vorname & Nachname --}}
    @elseif ($user->firstname !== null && $user->surname != null)
        {{-- Hallo Max Mustermann --}}
         {{ __('mail.salutation_private') }}{!! __('mail.title',  ['name' => $user->firstname . ' ' . $user->surname]) !!}
    @endif
@endif

