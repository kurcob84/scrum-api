@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => __('mail.password_change_subject'),
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')
    @include('mail.salutation', ['user' => $user])
    {!! __('mail.password_change_text') !!}

    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => __('mail.to_portal'),
        	'link' => env('APP_URL_WEB')
    ])

@stop