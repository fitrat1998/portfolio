@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <h1 class="h3 mb-0">Foydalanuvchilar</h1>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>
                        Qo'shish
                    </a>
                    {{--                    <button type="button" class="btn btn-outline-secondary"--}}
                    {{--                            data-bs-toggle="tooltip"--}}
                    {{--                            title="Refresh data">--}}
                    {{--                        <i class="bi bi-arrow-clockwise icon-hover"></i>--}}
                    {{--                    </button>--}}
                    {{--                    <button type="button" class="btn btn-outline-secondary"--}}
                    {{--                            data-bs-toggle="tooltip"--}}
                    {{--                            title="Export data">--}}
                    {{--                        <i class="bi bi-download icon-hover"></i>--}}
                    {{--                    </button>--}}
                    {{--                    <button type="button" class="btn btn-outline-secondary"--}}
                    {{--                            data-bs-toggle="tooltip"--}}
                    {{--                            title="Settings">--}}
                    {{--                        <i class="bi bi-gear icon-hover"></i>--}}
                    {{--                    </button>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped statistics">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Fish</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Amallar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email ?? 'mavjud emas' }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge rounded-pill bg-info me-2 mb-2">
                                    {{ $role->title }}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('O‘chirishga ishonchingiz komilmi?')"><i
                                        class="bi bi-trash"></i>

                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection
