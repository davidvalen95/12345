@extends('auth.formMaster')


@section('formTitle','Register new user')

@section('action',action('Auth\RegisterController@register'))


@section('button')
    <div class="col-xs-12">
      <button type="submit" class="mCenter btn btn-primary btn-block btn-flat mBackground-0">Register</button>
    </div>
@endSection
