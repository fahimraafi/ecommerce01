@extends('layouts.dashboard');

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Successfully Logged In') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>
                        Welcome {{ auth()-> user()-> name }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
