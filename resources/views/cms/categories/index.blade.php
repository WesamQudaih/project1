@extends('cms.parent')
@section('style')
    <style>
        .delete-btn {
            color: red;
            outline-width: 0px;
            outline-color: white;
            border-width: 0px;
            background-color: transparent;
            padding: 0px;
        }

        .actions {
            display: flex;
            flex-direction: row;
            column-gap: 10px;
        }

        .active {
            color: green;
        }

        .in-active {
            color: red;
        }
    </style>
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Responsive Hover Table</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Active</th>
                                        <th>User</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr id="category_{{ $category->id }}">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $category->title }}</td>
                                            <td>
                                                @if ($category->active)
                                                    <span class="active">Active</span>
                                                @else
                                                    <span class="in-active">In-Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $category->user->name }}
                                            </td>
                                            <td>{{ $category->created_at ?? '-' }}</td>
                                            {{-- <td><span class="tag tag-success">Approved</span></td> --}}
                                            <td class="actions">
                                                <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                                {{-- <form action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="delete-btn" type="submit">Delete</button>
                                                </form> --}}
                                                <button class="delete-btn" onclick="deleteCategory('{{ $category->id }}')"
                                                    type="button">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        function deleteCategory(id) {
            axios.delete('/cms/admin/categories/' + id)
                .then(function(response) {
                    document.getElementById(`category_${id}`).remove();
                    Swal.fire({
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
                .catch(function(error) {
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: error.response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
        }
    </script>
@endsection
