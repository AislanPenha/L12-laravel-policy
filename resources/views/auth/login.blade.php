@extends('layouts.main_layout')
@section('content')
    <div class='d-flex justify-content-center gap-5 mt-5'>
        <a href="{{ route('login_user', 1) }}" class="btn btn-lg btn-outline-primary px-5">Login Admin</a>
        <a href="{{ route('login_user', 2) }}" class="btn btn-lg btn-outline-primary px-5">Login User</a>
        <a href="{{ route('login_user', 3) }}" class="btn btn-lg btn-outline-primary px-5">Login Visitor</a>
        <a href="{{ route('login_user', 4) }}" class="btn btn-lg btn-outline-primary px-5">AISLAN (SUPER)</a>
    </div>
@endsection