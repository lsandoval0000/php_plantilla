<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" href="{{ asset('favicon.png') }}">

  <title>@yield('title',config('app.name'))</title>

  <link rel="stylesheet" href="/css/error.css">
  <link rel="stylesheet" href="/css/app.css">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 </head>
 <body class="pep-error pep-error--code-404">
	<div class="pep-error__mascot">
        <svg class="ghost" xmlns="http://www.w3.org/2000/svg" width="164" height="245" viewBox="0 0 164 245">
            <g class="ghost__body">
                <path class="ghost__body__inner" fill="#F0F0F0"
                      d="M162 172l-16-15-16 15-16-15-16 15-16-15-16 15-16-15-16 15-16-15-16 15V82C2 38 38 2 82 2s80 36 80 80v90z"/>
                <path class="ghost__body__shadow" fill="#E0E0E0"
                      d="M82 2c-4 0-7.7.3-11.5.8C109 8.5 139 41.8 139 82v81.6l7-6.6 16 15V82c0-44-36-80-80-80z"/>
                <path class="ghost__body__outline" fill="none" stroke="#666" stroke-width="4" stroke-linecap="round"
                      stroke-linejoin="round" stroke-miterlimit="10"
                      d="M162 172l-16-15-16 15-16-15-16 15-16-15-16 15-16-15-16 15-16-15-16 15V82C2 38 38 2 82 2s80 36 80 80v90z"/>
                <g class="ghost__face">
                    <circle class="ghost__face__eye ghost__face__eye--left" fill="#666" cx="42" cy="89" r="4"/>
                    <circle class="ghost__face__eye ghost__face__eye--right" fill="#666" cx="122" cy="89" r="4"/>
                    <path class="ghost__face__mouth" fill="none" stroke="#666" stroke-width="4" stroke-linecap="round"
                          stroke-linejoin="round" stroke-miterlimit="10" d="M71 131h22"/>
                </g>
            </g>
            <ellipse class="ghost__shadow" fill="#EEE" cx="82" cy="234" rx="74" ry="11"/>
        </svg>
    </div>
    <h1 class="pep-error__title">Error!</h1>
    <h2 class="pep-error__description">Ocurrió un error mientras se trataba de realizar la operación, vuelva a intentarlo.</h2>
	<a class="btn btn-primary btn-block" href="{{ route('home') }}">Volver</a>
 </body>
 </html>