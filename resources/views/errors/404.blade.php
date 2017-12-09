@if (auth()->user())
@php ($data['message']='not-found')
@include('errors.error-page')
@else
@include('errors.route-error-page')
@endif