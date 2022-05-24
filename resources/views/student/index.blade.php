@extends('student.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>INFORMATION TECHNOLOGY-STATE POLYTECHNIC OF MALANG</h2>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('student.create') }}"> Input Student Data</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif


    <form action="/student/search" method="GET">
		<input type="text" name="search" placeholder="Search Student data by nim" value="{{ old('search') }}">
		<input type="submit" value="search">
	</form>



    <table class="table table-bordered">
            <tr>
                <th>Nim</th>
                <th>Name</th>
                <th>Class</th>
                <th>Major</th>
                <th>Address</th>
                <th>Date of Birth</th>
                <th>Photo</th>
                <th width="300px">Action</th>
            </tr>
        @foreach ($paginate as $mhs)
        <tr>
            <td>{{ $mhs ->nim }}</td>
            <td>{{ $mhs ->name }}</td>
            <td>{{ $mhs ->class->class_name }}</td>
            <td>{{ $mhs ->major }}</td>
            <td>{{ $mhs ->Address }}</td>
            <td>{{ $mhs ->Date_of_Birth }}</td>
            <td><image width="50px" src="{{ asset('storage/'.$mhs->photo )}}" alt=""></td> <!--{{asset('storage/'.$article->featured_image)}}-->
            <td>
            <form action="{{ route('student.destroy',['student'=>$mhs->nim]) }}" method="POST">
                <a class="btn btn-info" href="{{ route('student.show',$mhs->nim) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('student.edit',$mhs->nim) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
                <a class="btn btn-warning" href="{{ route('student.mark',$mhs->nim) }}">Mark</a>
            </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex float-right">
        {{$paginate->links('pagination::bootstrap-4')}}
    </div>
@endsection