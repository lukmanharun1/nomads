@extends('layouts.success')

@section('title', 'Checkout Success')
@section('content')
<main>
  <div class="section-success d-flex align-items-center">
    <div class="col text-center">
     
      <h1>Oops!</h1>
      <p>
        Your transcation is unfinished.
      </p>
      <a href="{{url('/')}}" class="btn btn-home-page mt-3 px-5">Home Page</a>
    </div>
  </div>
</main>  
@endsection
