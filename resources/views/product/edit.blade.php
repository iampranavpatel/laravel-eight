@extends('layouts.app')
@section('content')
<div class="outer-wrap mt-5 mx-auto w-50">
  <div class="sub-wrap">
    <p class="h1">Add product</p>
  </div>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <form action="{{ route('product.update',$singleProduct->id) }}" method="POST">
    @csrf
    <table class="table">
      <tbody>
        <tr>
          <td>
            Product Name
          </td>
          <td>
            <input 
              type="text" 
              name="name" 
              class="form-control" 
              placeholder="Name"
              value={{ $singleProduct->name }}
            >
          </td>
        </tr>
        <tr>
          <td>
            Product Detail
          </td>
          <td>
            <textarea
              name="detail"
              class="form-control"
              placeholder="Details"
              cols="52"
              rows="7">{{ $singleProduct->detail }}</textarea>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="sub-wrap text-center">
      <button 
      type="submit" 
      class="btn btn-primary">
      Update
      </button>
    </div>
  </form>
</div>
@endsection('content')