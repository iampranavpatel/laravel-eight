@extends('layouts.app')
@section('content')
<div class="outer-wrap mt-5">
  @if ($message = Session::get('success'))
  <div class="alert alert-success">
  <p>{{ $message }}</p>
  </div>
  @elseif ($message = Session::get('error'))
  <div class="alert alert-danger">
  <p>{{ $message }}</p>
  </div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <div class="row row-list">
    <div class="sub-wrap d-inline-block">
      <p class="h1">Product list</p>
    </div>
    <div class="sub-wrap d-inline-block w-25">
      <a href="{{url('product/add')}}">
        <button type="button" class="btn btn-success float-right">
          Add
        </button>
      </a>
    </div>
    <div class="w-50">
      <form
        id=""
        class="w-75 d-flex justify-content-end d-flex float-right"
        action="{{ route('product.search') }}"
        method="POST">
        @csrf

        <input
          type="text"
          name="search"
          class="w-50 form-control"
          placeholder="search" 
        />
        <button
          type="submit"
          class="w-50 form-control btn btn-dark"
        >submit</button>
      </form>
    </div>
  </div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Product Name</th>
        <th scope="col">Product Description</th>
        <th scope="col">Operations</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
      <tr>
        <td scope="row">
          <strong>
          {{
            ++$i
          }}
          </strong>
        </td>
        <td>{{ $product->name }}</td>
        <td class="col-md-4">{{ $product->detail }}</td>
        <td>
          <a href="{{ route('product.show',$product->id) }} ">
            <button type="button" class="btn btn-info">
                View
            </button>
          </a>
          <a href="{{ route('product.edit',$product->id) }}">
            <button type="button" class="btn btn-secondary">
              Edit
            </button>
          </a>
          <form
            id="delete-me"
            class="btn px-0"
            action="{{ route('product.delete',$product->id) }}"
            method="POST">
            @csrf 
            <button
              data-row-id="{{$product->id}}"
              type="submit"
              class="btn btn-danger">
              Delete
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
    {{ $products->links() }}
</div>
@endsection('content')

@push('head')
  <script type="text/javascript">
    $(document).on("click", "#delete-me", function () {
      if (confirm('Are you sure ?')) {
        return true;
      }
      return false;
    });
  </script>
@endpush
