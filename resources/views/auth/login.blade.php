@extends('auth.formMaster')

@section('formTitle', 'Login')



@section('action',url('login'))


@section('button')

<div class="col-xs-8">
  <button type="submit" class="mCenter btn btn-primary btn-block btn-flat mBackground-0">Login</button>
</div>

<div class="col-xs-4">
  <a href={{action('Auth\RegisterController@showRegistrationForm')}} class="mCenter btn btn-primary btn-block btn-flat mBackground-2">Register</a>
</div>

@endSection
