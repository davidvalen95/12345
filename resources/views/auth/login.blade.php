@extends('auth.formMaster')




@if (isset($forgotPassword))
    @section('formTitle', 'Reset password')
    @section('action',route('postForgotPassword'))
@else
    @section('formTitle', 'Login')
    @section('action',url('login'))
@endIf









@section('button')

    @if (!isset($forgotPassword))
        <div class="col-xs-4">
          <button type="submit" class="mCenter btn btn-primary btn-block btn-flat mBackground-0">Login</button>
        </div>
        <div class="col-xs-4">
          <a href={{action('Auth\RegisterController@showRegistrationForm')}} class="mCenter btn btn-primary btn-block btn-flat mBackground-2">Register</a>
        </div>

        <div class="col-xs-4">
          <a href={{route('getForgotPassword')}} class="mCenter btn btn-primary btn-block btn-flat mBackground-2">Forget PW</a>
        </div>


    @else

        <div class="col-xs-8">
          <button type="submit" class="mCenter btn btn-primary btn-block btn-flat mBackground-0">Reset</button>
      </div>
      <div class="col-xs-4">
        <a href='{{route('login')}}' class="mCenter btn btn-primary btn-block btn-flat mBackground-2">Back</a>
      </div>
    @endIf

@endSection
