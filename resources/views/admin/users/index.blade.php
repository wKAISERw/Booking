@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0"><i class="bi bi-people me-2"></i>Manage Users</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th class="ps-4">Name</th>
                        <th>Email</th>
                        <th>Current Role</th>
                        <th class="pe-4 text-end">Change Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold">{{ $user->name }}</div>
                                <small class="text-muted">ID: #{{ $user->id }}</small>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role === 'admin')
                                    <span class="badge bg-primary px-3">Administrator</span>
                                @else
                                    <span class="badge bg-light text-dark border px-3">User</span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <form action="{{ route('admin.users.updateRole', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($user->role === 'admin')
                                        <input type="hidden" name="role" value="user">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">Demote to User</button>
                                    @else
                                        <input type="hidden" name="role" value="admin">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Make Admin</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 pt-3">
            {{ $users->links() }}
        </div>
    </div>
@endsection
