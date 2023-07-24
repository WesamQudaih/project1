@extends('cms.parent')


@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- <form method="POST" action="{{ route('users.update', $user->id) }}"> --}}
                        <form>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>User</label>
                                    <select class="form-control" name="user_id" id="user_id">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" value="{{ $category->title }}"
                                        placeholder="Enter title">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        {{-- <input type="checkbox" class="custom-control-input" id="active"
                                            @if ($category->active) checked @endif> --}}
                                        <input type="checkbox" class="custom-control-input" id="active"
                                            @checked($category->active)>
                                        <label class="custom-control-label" for="active">Category Active Status</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="updateCategory('{{ $category->id }}')"
                                    class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        function updateCategory(id) {
            axios.put(`/cms/admin/categories/${id}`, {
                    user_id: document.getElementById('user_id').value,
                    title: document.getElementById('title').value,
                    active: document.getElementById('active').checked
                })
                .then(function(response) {
                    window.location.href = '/cms/admin/categories'
                    // showMessage('success', response.data.message);
                })
                .catch(function(error) {
                    showMessage('error', error.response.data.message);
                })
        }

        function showMessage(icon, message) {
            Swal.fire({
                icon: icon,
                title: message,
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>
@endsection
