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
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Categories Count</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->fullMobile }}</td>
                                            <td>
                                                @if (!is_null($user->address))
                                                    <span style="font-weight: bold">{{ $user->address }}</span>
                                                @else
                                                    <span style="color: red; font-weight: bold">NO Address</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $user->categories_count }}
                                            </td>
                                            <td>{{ $user->created_at ?? '-' }}</td>
                                            {{-- <td><span class="tag tag-success">Approved</span></td> --}}
                                            <td class="actions">
                                                <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="delete-btn" type="submit">Delete</button>
                                                </form>
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
