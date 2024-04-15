@extends('layout.dashboard')
@section('title', 'User')
@section('content')
<div class="p-2"> 
    <h4>Dashboard</h4>
    <h6 class="font-weight-light">Dashboard / <span class="font-weight-bold"> user </span></h6>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Users Table</h4>
                <div class="card-header-form">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <a href="{{ route('dashboard.get.auth') }}" class="btn btn-primary" style="background-color: #572D0C"><i class="fas fa-plus"></i> New Account</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Last Login</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($userAccounts as $acc)
                        <tr>
                            <td>{{ $acc->name }}</td>
                            <td>{{ $acc->username }}</td>
                            @if ($acc->role === 'Admin')
                            <td>
                                <div class="badge badge-success">Admin</div>
                            </td>
                            @else
                            <td>
                                <div class="badge badge-info">Petugas</div>
                            </td>
                            @endif
                            @if ($acc->last_login == null)
                            <td>Belum Login</td>
                            @else
                            <td>{{ $acc->last_login }}</td>
                            @endif
                            <td>
                                <a href="#" class="btn btn-success btn-sm font-weight-bold text-xs edit-btn" data-id="{{ $acc->id }}" data-name="{{ $acc->name }}" data-email="{{$acc->email}}" data-username="{{ $acc->username }}" data-role="{{ $acc->role }}" data-password="{{ $acc->password}}">
                                    Edit
                                </a>
                                <form action="{{ route('dashboard.user.delete', $acc->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete user">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Update Modal -->
                        <div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateUserModalLabel">Update User Information</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="updateUserForm" action="{{ route('dashboard.user.update', $acc->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="modal-body">
                                            <input type="hidden" name="user_id" id="user_id">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" id="username" name="username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <select class="form-control" id="role" name="role" required>
                                                    <option value="ADMIN">Admin</option>
                                                    <option value="PETUGAS">Petugas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.edit-btn').click(function() {
            var userId = $(this).data('id');
            var name = $(this).data('name');
            var username = $(this).data('username');
            var email = $(this).data('email') ;
            var role = $(this).data('role');
            var password = $(this).data('password');

            $('#user_id').val(userId);
            $('#name').val(name);
            $('#username').val(username);
            $('#email').val(email);
            $('#role').val(role);
            $('#password').val(password);

            $('#updateUserModal').modal('show');
        });
    });
</script>
@endsection