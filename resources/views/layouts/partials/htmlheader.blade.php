<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    {!! Html::style('components/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('components/css/font-awesome.min.css') !!}
    {!! Html::style('components/css/simple-sidebar.css') !!}
    {!! Html::style('components/css/custom.css') !!}
    {!! Html::style('components/jquery-ui/jquery-ui.min.css') !!}
</head>