@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="col-md-8 col-md-offset-2">
                    @if (session('notification')) 

                        <div class="alert alerr-seccess">
                            {{ session('notification')}}
                        </div>
                        
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
