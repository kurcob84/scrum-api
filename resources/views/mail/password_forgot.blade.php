@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => __('mail.password_forgot_subject'),
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')
    @include('mail.salutation', ['user' => $user])
    {!! __('mail.password_forgot_text') !!}

    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => __('mail.passwor_change'),
        	'link' => $token
    ])

@stop