@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-8 offset-md-2">

                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Category</h5>

                        <a href="{{ route('category') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($categories->count() > 0)
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $category->categoryName }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>
                                                <img src="{{ asset('/uploads/category/' . $category->image) }}"
                                                    style="height: 60px; object-fit:contain;" class="img-fluid"
                                                    alt="Category Image">
                                            </td>
                                            <td>
                                                {{-- {{ $category->status }} --}}
                                                <!--<a href="#" class="btn btn-sm btn-success cat_active">Active</a>-->
                                                <!--<a href="#" class="btn btn-sm btn-success cat_inactive"-->
                                                <!--    style="display: none;">Inactive</a>-->
                                                <form action="{{ route('category.status', $category->id) }}" method="POST">
                                                    @csrf
                                                    @if ($category->status == 0)
                                                        <button class="btn btn-sm btn-danger status_inactive"
                                                            value="{{ $category->id }}">Inactive</button>
                                                    @else
                                                        <button class="btn btn-sm btn-success status_active"
                                                            value="{{ $category->id }}">Active</button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <ul class="dropdown-menu" data-popper-placement="bottom-start"
                                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 40px, 0px);">
                                                        <li><a href="{{ route('category.edit', $category->id) }}"
                                                                class="dropdown-item">Edit</a></li>
                                                        <li><a href="{{ route('category.delete', $category->id) }}"
                                                                class="dropdown-item" id="delete">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center text-warning">Data not Found</td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
@endsection
