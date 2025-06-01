@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12">

                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Review Rating</h5>

                        {{-- <a href="{{ route('banner') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a> --}}
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>User Name</th>
                                    <th>Product Name</th>
                                    <th>Review</th>
                                    <th>image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $rating)
                              <tr>



                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rating->user->userName??'' }}</td>
                                <td>{{ $rating->product->product_name??'' }}</td>
                                <td>{{ $rating->review??'' }}</td>

                                <td>
                                @foreach($rating->gallary as $galleryImage)
                                <img src="{{ asset('uploads/review_image/'.$galleryImage->image) }}" alt="" style="height:50px;width:50px">
                               @endforeach
                                </td>
                                <td>
                                    <span class="  ">{{$rating->review_status??''}}</span>
                                </td>
                                <td>
                                    <a href="{{ route('review.approve',$rating->id) }}" class="btn btn-info btn-sm text-light "> Approve </a>
                                    <a href="{{ route('review.delete',$rating->id) }}" class="btn btn-danger btn-sm text-light "> Cancel </a>
                                </td>
                              </tr>

                              @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>


    <script>
        // $(document).ready(function() {
        //     // let csrfToken = $('meta[name="csrf-token"]').attr('content');
        //     $('.home_banner_active').on('click', function(e) {
        //         e.preventDefault();
        //         // alert('ok')

        //         $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         });
        //         let id = this.getAttribute('value');
        //         $.ajax({
        //             url: '/banner/status/' + id,
        //             type: "POST",
        //             data: {
        //                 status: 0
        //             },
        //             contentType: false,
        //             processData: false,
        //             // headers: {
        //             //     'X-CSRF-TOKEN': csrfToken
        //             // },
        //             suuccess: function(response) {
        //                 console.log(response);
        //             }
        //             // error: function(xhr, status, error) {
        //             //     console.error(xhr.responseText);
        //             // }
        //         })

        //     });
        // });
    </script>
@endsection
