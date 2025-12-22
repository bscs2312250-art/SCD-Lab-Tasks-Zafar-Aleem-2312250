@extends('layouts.master')

@section('content')
<div class="container" style="max-width: 800px;">
    <div class="card">
        <h2>Dashboard</h2>
        <div class="text-center">
            <p>Welcome, <strong>{{ Auth::user()->name }}</strong>!</p>
            <p style="color: var(--text-muted);">You have successfully logged in.</p>
        </div>
    </div>
</div>
@endsection
