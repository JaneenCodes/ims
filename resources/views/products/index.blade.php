@extends('layouts.master')

@section('content')
    <div class="py-12 p-5">
        <div class="container">
            <div class="card shadow-xl rounded-2xl">
                <div class="card-body text-gray-900">

                    <div class="d-flex justify-content-end mb-6 mb-3">
                        @auth
                            @if(auth()->user()->role == 'admin')
                                <button type="button" class="create-btn btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#create-modal">
                                    + Create New Product
                                </button>
                            @endif
                        @endauth                    
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered  table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Supplier</th>
                                  
                                    @auth
                                        @if(auth()->user()->role == 'admin')
                                        <th scope="col" class="text-center">Action</th>
                                        @endif
                                    @endauth
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr class="hover-bg-light product-list">
                                        <td>{{ $product->SKU }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>₱ {{ $product->price }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->supplier }}</td>

                                        @auth
                                            @if(auth()->user()->role == 'admin')
                                            <td class="text-center">
                                                {{-- <a href="javascript:void(0)" 
                                                class="view-btn btn btn-success btn-sm rounded-start-pill" 
                                                data-url="">+RSTK
                                                </a> 
                                                <a href="javascript:void(0)" 
                                                class="view-btn btn btn-warning btn-sm rounded-end-circle" 
                                                data-url="">-DED
                                                </a>  --}}
                                      
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-success btn-sm rounded-start-pill"
                                                       data-url="">
                                                      +RSK
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-warning btn-sm rounded-end-pill"
                                                       data-url="">
                                                      -DED
                                                    </a>
                                     
    
                                                <a href="javascript:void(0)"
                                                class="edit-btn btn btn-primary btn-sm rounded-pill"
                                                data-id="{{ $product->id }}"
                                                data-name="{{$product->name}}" 
                                                data-price="{{$product->price}}"
                                                data-quantity="{{$product->quantity}}"
                                                data-supplier="{{$product->supplier}}">
                                                Edit
                                                </a>
    
                                                <a href="javascript:void(0)" 
                                                class="delete-btn btn btn-danger btn-sm rounded-pill" 
                                                data-url="{{ route('product.destroy', $product->id) }}">Delete
                                                </a> 
                                                
                                            </td>
                                            @endif
                                        @endauth
                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No Records Found</td>
                                    </tr>
                                @endforelse
                               
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

  
<!--Create Product Modal -->
<div class="modal fade" id="create-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color: #3374c9">Create</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="create-form" class="p-4 md:p-5">
                    @csrf       

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
                    <div class="row g-4">
                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Type product name">
                        </div>
                
                        <div class="col-12 col-sm-6">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control">
                        </div>
                
                        <div class="col-12 col-sm-6">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" id="price" class="form-control" >
                        </div>
                
                        <div class="col-12">
                            <label for="supplier" class="form-label">Supplier</label>
                            <input type="text" name="supplier" id="supplier" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary create-submit-btn">+ Add new product</button>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" id="edit-form">
            @csrf       

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Type product name" required>
                        </div>
                
                        <div class="col-12 col-sm-6">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" required>
                        </div>
                
                        <div class="col-12 col-sm-6">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                
                        <div class="col-12">
                            <label for="suplier" class="form-label">Supplier</label>
                            <input type="text" name="supplier" id="supplier" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
  

<script src="{{asset("js/jquery-3.7.1.min.js")}}" ></script>
<script src="{{asset("js/custom.js")}}" ></script>

@endsection
