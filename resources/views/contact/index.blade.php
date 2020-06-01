@extends('layouts.app')
@push('head')
    <script src="{{ asset('js/buttonEvent.js')}}"></script>
@endpush
@section('content')

    <div class="container">
        <div>
            <h3>Import contacts from csv</h3>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{$message}}</p>
                </div>
            @endif
            <h5>CSV format (with ; delimiter)</h5>
            <table class="table table-hover table-sm">
                <tr>
                    <th>first_name</th>
                    <th>phone</th>
                    <th>e-mail</th>
                </tr>
            </table>
            <form method="POST" action="{{ route('contact.csvImport') }}" enctype="multipart/form-data">
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control" name="file" accept=".csv"/>
                </div>
                <button type="submit" class="btn btn-primary">Import</button>
            </form>

        </div>

        <div class="row">
            <div class="col-md-8">
                <h3>Your Contacts</h3>
            </div>
            <div class="col-sm-4">
                <a class="btn byn-sm btn-success" href="{{ route('contact.create') }}">Add new</a>
            </div>
        </div>
        <table class="table table-hover table-sm">
            <tr>
                <th width="50px"><b>No.</b></th>
                <th width="300px"><b>First name</b></th>
                <th>Phone</th>
                <th>E-mail</th>
                <th width="180px">Action</th>
            </tr>

            @foreach($contacts as $i => $contact)
                <tr>
                    <td><b>{{++$i}}.</b></td>
                    <td>{{$contact->first_name}}</td>
                    <td>{{$contact->phone}}</td>
                    <td>{{$contact->email}}</td>
                    <td>
                        <form action="{{route('contact.destroy', $contact->id)}}" method="post">

                            {{-- @TODO move tracking to js --}}
                            <a class="btn btn-sm btn-dark" href="{{route('contact.track',$contact->id)}}">Track</a>
                            <a class="btn btn-sm btn-warning" href="{{route('contact.edit',$contact->id)}}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

    </div>
@endsection
