@extends('layouts.app')
@section('content')
<div class="outer-wrap mt-5 mx-auto w-50">
  <div class="sub-wrap">
    <p class="h1">Add product</p>
  </div>
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
              disabled
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
              disabled
              rows="7">{{ $singleProduct->detail }}</textarea>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="sub-wrap text-right">
      <a href="{{route('product.index')}}">
        <button 
        type="submit" 
        class="btn btn-primary">
          Back
        </button>
      </a>
    </div>
</div>
@endsection('content')