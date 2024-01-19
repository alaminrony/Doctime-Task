@extends('layouts.app')
@section('content')
    <form action="{{ route('bulk.upload.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="formFileLg" class="form-label">Upload User CSV File</label>
            <input class="form-control form-control-lg" type="file" name="mycsv">
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
@endsection
