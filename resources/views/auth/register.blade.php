@extends('auth.formMaster')


@section('formTitle','Register new user')

@section('action',action('Auth\RegisterController@register'))


@section('button')
    <div class="col-xs-8">
      <button type="submit" class="mCenter btn btn-primary btn-block btn-flat mBackground-0">Register</button>
    </div>
    <div class="col-xs-4">
      <a href='{{route('login')}}' class="mCenter btn btn-primary btn-block btn-flat mBackground-2">Back</a>
    </div>
@endSection
