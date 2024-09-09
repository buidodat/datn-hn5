@extends('admin.layouts.master')

@section('title')
    Danh sách bài viết
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection



@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách bài viết</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bài viết</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Danh sách bài viết</h5>
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary mb-3 ">Thêm mới</a>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success m-3">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tiêu đề</th>
                                <th>Hình ảnh</th>
                                <th>Mô tả ngắn</th>
                                <th>Nội dung</th>
                                <th>Slug</th>
                                <th>Hoạt động</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td style="!implement width: 5%">{{ $post->title }}</td>
                                    <td>
                                        @if ($post->image && \Storage::exists($post->image))
                                            <img src="{{ Storage::url($post->image) }}" alt="" width="50px">
                                        @else
                                            No image !
                                        @endif

                                        @php
                                            $url = $post->image;

                                            if (!\Str::contains($url, 'http')) {
                                                $url = Storage::url($url);
                                            }

                                        @endphp
                                        @if (!empty($post->image))
                                            <img src="{{ $url }}" alt="" width="100px">
                                        @else
                                            No image !
                                        @endif

                                    </td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ $post->author->name }}</td>
                                    <td>{{ $post->views }}</td>
                                    <td>{!! $post->is_active ? '<span class="badge bg-primary">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                                    <td>{!! $post->is_popular ? '<span class="badge bg-primary">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                                    <td>{!! $post->is_hot_post ? '<span class="badge bg-primary">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                                    <td>{{ $post->slug }}</td>
                                    <td>
                                        @foreach ($post->tags as $tag)
                                            <span class="badge bg-info">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $post->updated_at }}</td>
                                    <td>


                                        <a href="">
                                            <button title="xem" class="btn btn-success btn-sm " type="button"><i
                                                    class="fas fa-eye"></i></button></a>

                                        <a href="">
                                            <button title="xem" class="btn btn-warning btn-sm " type="button"><i
                                                    class="fas fa-edit"></i></button>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody> --}}
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td style="!implement width: 5%">{{ $post->title }}</td>
                                    <td>
                                        @if (!empty($post->img_post))
                                            <img width="100px" src="{{ Storage::url($post->img_post) }}" alt="">
                                        @else
                                            Không có ảnh
                                        @endif

                                    </td>
                                    <td>{{ $post->description }}
                                    </td>
                                    <td>{{ $post->content }}</td>
                                    <td>{{ $post->slug }}</td>
                                    <td>

                                        @if ($post->is_active == 1)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>


                                    <td>
                                        <a href="#">
                                            <button title="xem" class="btn btn-success btn-sm " type="button"><i
                                                    class="fas fa-eye"></i></button></a>
                                        <a href="{{ route('admin.posts.edit', $post) }}">
                                            <button title="xem" class="btn btn-warning btn-sm " type="button"><i
                                                    class="fas fa-edit"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection


@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
