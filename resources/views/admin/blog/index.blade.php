@extends('layout.mainlayout_admin')
@section('title', 'Blogs')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">Blogs <span class="ms-1">{{ count($blogs) }}</span></div>
                        {{--                        <a href="{{ route('doctor.create') }}" class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> Add New</a>--}}
                    </div>
                </div>
            </div>
            @if(session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif
            <!-- Doctor List -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">Blogs</h5>
                                </div>
                                <div class="col-auto d-flex flex-wrap">
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        {{--                                        <th>Doctor</th>--}}
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($blogs as $blog)
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a class="avatar avatar-sm me-2">
                                                        <img class="avatar-img rounded-circle"
                                                             src="{{ asset_img('', $blog->blog_image) }}">
                                                    </a>

                                                    <a>{{ $blog->blog_title }}<span></span></a>
                                                </h2>
                                            </td>
                                            {{--                                            <td>{{ $blog->user->name }}</td>--}}
                                            <td>{{ $blog->created_at->diffForHumans() }}</td>
                                            <td>{{ $blog->updated_at->diffForHumans() }}</td>
                                            <td class="text-end">
                                                <div class="table-action">
                                                    <a href="{{ route('show_blog', $blog) }}"
                                                       class="btn btn-sm bg-success-light">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                    <a href="{{ route('edit_blog', $blog) }}"
                                                       class="btn btn-sm bg-success-light">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                       onclick="if (window.confirm('Are you sure you want to delete this blog')){ document.getElementById( 'delete{{ $blog->id }}').submit(); }"
                                                       class="btn btn-sm bg-danger-light">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                </div>
                                            </td>
                                            <form method="POST" id="delete{{ $blog->id }}"
                                                  action="{{ route('delete_blog', $blog) }}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </tr>
                                    @empty
                                        <tr class="col-span-4">
                                            <td class="col-span-4">No Blogs Available</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tablepagination" class="dataTables_wrapper"></div>
                </div>
            </div>
            <!-- /Doctor List -->
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->
@endsection
