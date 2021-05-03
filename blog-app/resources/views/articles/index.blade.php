@extends('articles.layout')
 
@section('content')
    <div class="row" style="margin-top: 5rem;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example from scratch - laravelcode.com</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('articles.create') }}"> Create New Post</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>no</th>
            <th>title</th>
            <th>content</th>
            <th width="280px">image</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $value)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $value->post_title }}</td>
            <td>{{ \Str::limit($value->post_content, 100) }}</td>
            <td>
                @if ($value->img_path != '')
                    <img src="{{ $value->img_path }}" style="width:100%;"/>
                @endif
            </td>
            <td>
                <form action="{{ route('articles.destroy',$value->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('articles.show',$value->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('articles.edit',$value->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $data->links() !!}
@endsection