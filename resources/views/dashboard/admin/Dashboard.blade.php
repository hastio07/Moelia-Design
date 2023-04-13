@extends('dashboard.admin.layouts.layouts')
@section('title', 'Dashboard')
@section('content')
    <h1>Hi {{ auth()->user()->nama_depan . ' ' . auth()->user()->nama_belakang }}</h1>
@endsection
