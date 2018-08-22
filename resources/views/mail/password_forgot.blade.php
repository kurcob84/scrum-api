@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => __('mail.password_forgot_subject'),
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        {!! trans_choice('mail.password_salutation', $user->salutation) !!}
        {!! __('mail.password_forgot_text',  ['name' => $user->surname]) !!}

    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => __('mail.to_portal'),
        	'link' => env('APP_URL_WEB')
    ])

@stop