@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => __('mail.register_subject'),
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        {!! __('mail.register_text') !!}

    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => __('mail.confirm'),
        	'link' => $user->confirm_code
    ])

@stop