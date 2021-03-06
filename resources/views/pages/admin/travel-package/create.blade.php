@extends('layouts.admin')

@section('content')
     <!-- Begin Page Content -->
 <div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Tambah Paket Travel</h1>
  </div>

  @if ($errors->any())  
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}} </li>
        @endforeach
      </ul>
    </div>
      
  @endif
  <div class="car shadow">
    <div class="card-body">
      <form action="{{route('travel-package.store')}}" method="POST">
        @csrf
        
          <div class="form-group row col-lg-5">
            <label for="title">Title</label>
            <input type="text" class="form-control" placeholder="Title" name="title" value="{{old('title')}}">
          </div>

          <div class="form-group row col-lg-5">
            <label for="location">Location</label>
            <input type="text" class="form-control" placeholder="Location" name="location" value="{{old('location')}}">
          </div>

          <div class="form-group row col-lg-5">
            <label for="about">About</label>
            <textarea name="about" id="about" rows="5" class="d-block w-100 form-control">{{old('about')}}</textarea>
          </div>
          <div class="form-group row col-lg-5">
            <label for="featured_event">Featured Event</label>
            <input type="text" class="form-control" name="featured_event" placeholder="Featured Event" value="{{ old('featured_event') }}">
          </div>

          <div class="form-group row col-lg-5">
            <label for="language">Language</label>
            <input type="text" class="form-control" name="language" placeholder="Language" value="{{ old('language') }}">
          </div>

          <div class="form-group row col-lg-5">
            <label for="foods">Foods</label>
          <input type="text" class="form-control" name="foods" placeholder="Foods" value="{{ old('foods') }}">
          </div>

          <div class="form-group row col-lg-5">
            <label for="departure_date">Departure Date</label>
          <input type="date" class="form-control" name="departure_date" placeholder="Departure Date" value="{{ old('departure_date') }}">
          </div>

          <div class="form-group row col-lg-5">
            <label for="duration">Duration</label>
          <input type="text" class="form-control" name="duration" placeholder="Duration" value="{{ old('duration') }}">
          </div>

          <div class="form-group row col-lg-5">
            <label for="type">Type</label>
          <input type="text" class="form-control" name="type" placeholder="Type" value="{{ old('type') }}">
          </div>

          <div class="form-group row col-lg-5">
            <label for="price">Price</label>
          <input type="number" class="form-control" name="price" placeholder="Price" value="{{ old('price') }}">
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </div>
 </div>

<!-- /.container-fluid -->
@endsection