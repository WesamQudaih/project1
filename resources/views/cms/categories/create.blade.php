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
                            <h3 class="card-title">Create Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- <form method="POST" action="{{ route('categories.store') }}"> --}}
                        <form>
                            @csrf
                            <div class="card-body">
                                {{-- @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-ban"></i> Validation Error!</h5>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}
                                <div class="form-group">
                                    <label>User</label>
                                    <select class="form-control" name="user_id" id="user_id">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category_title">Title</label>
                                    <input type="text" class="form-control" id="category_title"
                                        placeholder="Enter title">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="active">
                                        <label class="custom-control-label" for="active">User Active Status</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                                <button type="button" onclick="createCategory()" class="btn btn-primary">Submit</button>
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
        function createCategory() {
            const token = document.getElementsByName('_token')[0].value;
            fetch('/cms/admin/categories', {
                    method: 'POST',
                    body: JSON.stringify({
                        '_token': token,
                        'title': document.getElementById('category_title').value,
                        'user_id': document.getElementById('user_id').value,
                        'active': document.getElementById('active').checked
                    }),
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                }).then((response) => {
                    console.log(response);
                    return response.json();
                })
                .then((response) => {
                    console.log(response);
                    Swal.fire({
                        position: 'center',
                        icon: response.icon,
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
                .catch((error) => {
                    console.log("Error")
                })
            //axios()
        }
    </script>
@endsection
