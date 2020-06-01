@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Add new contact</h3>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <br>Validation problem<br>
                <ul>
                    @foreach ($errors as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('contact.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <strong>First name :</strong>
                    <input type="text" name="first_name" class="form-control" placeholder="You name">
                </div>
                <div class="col-md-12">
                    <strong>Email :</strong>
                    <input type="email" class="form-control" placeholder="email@domain.xy" name="email"></input>
                </div>
                <div class="col-md-12">
                    <strong>Phone :</strong>
                    <input class="form-control" placeholder="+865-564-1272" name="phone"></input>
                </div>

                <div class="col-md-12">
                    <a href="{{route('contact.index')}}" class="btn btn-sm btn-success">Back</a>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </div>
        </form>

    </div>
@endsection
