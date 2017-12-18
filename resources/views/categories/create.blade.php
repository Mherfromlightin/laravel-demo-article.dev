@extends('layouts.app')

@section('content')
    <div class="col-sm-8 blog-main">
        <form action="{{ url('/categories') }}" method="POST">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="category">New Category:</label>
                <input type="text" class="form-control" id="category" name="name">
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
@endsection

@section('scripts')

@endsection()