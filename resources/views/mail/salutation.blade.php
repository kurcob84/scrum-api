{{-- Geschlecht --}}
@if ($user->salutation !== null)
    {{-- Vorname --}}
    @if ($user->firstname !== null && $user->surname == null)
        {{-- Hallo Patrick --}}
         {{ __('mail.salutation_private') }}{!! __('mail.title', ['name' => $user->firstname]) !!}
    {{-- Nachname --}}
    @elseif ($user->firstname == null && $user->surname !== null)
        {{-- Lieber Herr Rogge --}}
        {!! trans_choice('mail.salutation', $user->salutation) !!}{!! __('mail.title', ['name' => $user->surname]) !!}
    {{-- Vorname & Nachname --}}
    @elseif ($user->firstname !== null && $user->surname != null)
        {{-- Lieber Herr Patrick Patrick --}}
        {!! trans_choice('mail.salutation', $user->salutation) !!}{!! __('mail.title',  ['name' => $user->firstname . ' ' . $user->surname]) !!}
    @endif
{{-- Kein Geschlecht --}}
@elseif ($user->salutation == null)
    {{-- Vorname --}}
    @if ($user->firstname !== null && $user->surname == null)
        {{-- Hallo Patrick --}}
         {{ __('mail.salutation_private') }}{!! __('mail.title', ['name' => $user->firstname]) !!}
    {{-- Nachname --}}
    @elseif ($user->firstname == null && $user->surname !== null)
        {{-- Hallo Rogge --}}
         {{ __('mail.salutation_private') }}{!! __('mail.title', ['name' => $user->surname]) !!}
    {{-- Vorname & Nachname --}}
    @elseif ($user->firstname !== null && $user->surname != null)
        {{-- Hallo Patrick Patrick --}}
         {{ __('mail.salutation_private') }}{!! __('mail.title',  ['name' => $user->firstname . ' ' . $user->surname]) !!}
    @endif
@endif

