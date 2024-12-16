@extends('layouts.main')

@push('styles')
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endpush

@section('content')
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('index') }}" class="text-decoration-none">
            <i class='bx bx-arrow-back py-0 my-0 fs-2 mt-1 text-color'></i>
        </a>
        <h1 class="py-0 my-0">Dashboard</h1>
    </div>

    <div class="container-dashboard mt-4">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-2">
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-info">
                            <div class="icon" style="background-color: #ef41381c;">
                                <i class='bx bxs-group primary-color fs-3'></i>
                            </div>
                            <div class="detail">
                                <h5 class="text-color">Total Users</h5>
                                <h6 class="text-color">{{ $user->count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-info">
                            <div class="icon" style="background-color: #ef41381c;">
                                <i class='bx bxs-user-circle primary-color fs-3'></i>
                            </div>
                            <div class="detail">
                                <h5 class="text-color">Admin</h5>
                                <h6 class="text-color">{{ $user->where('roles', 'admin')->count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-info">
                            <div class="icon" style="background-color: #1987541c;">
                                <i class='bx bxs-check-circle fs-3' style="color: #198754;"></i>
                            </div>
                            <div class="detail">
                                <h5 class="text-color">Approved Users</h5>
                                <h6 class="text-color">{{ $user->where('status', 'approved')->count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-info">
                            <div class="icon" style="background-color: #dc35461c;">
                                <i class='bx bxs-shield-x fs-3' style="color: #dc3545;"></i>
                            </div>
                            <div class="detail">
                                <h5 class="text-color">Banned Users</h5>
                                <h6 class="text-color">{{ $user->where('status', 'banned')->count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="action d-flex align-items-center justify-content-between pt-5 pb-3">
            <h3 class="text-color">All Users</h3>
            <a href="#" class="d-flex align-items-center justify-content-center gap-2 text-decoration-none btn-primary rounded py-2 px-3" data-bs-toggle="modal" data-bs-target="#tambah-user-modal">
                <i class='bx bx-plus text-light fs-5'></i>
                <span class="text-light">Create user</span>
            </a>
        </div>
        <div class="table-responsive text-color pb-5">
            <table id="myDataTable" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <td>
                                <div class="username">
                                    <div class="username-info">
                                        <div class="avatar">
                                            @if (!empty($item->avatar))
                                                <img class="img" src="{{ asset('storage/avatars/' . $item->avatar) }}">
                                            @elseif (!empty($item->avatar_google))
                                                <img class="img" src="{{ $item->avatar_google }}">
                                            @else
                                                <img class="img"
                                                    src="https://ui-avatars.com/api/?background=random&name={{ urlencode($item->name) }}">
                                            @endif
                                        </div>
                                        <h6 class="text-color fw-normal py-0 my-0">{{ $item->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="roles-info">
                                    <h6 class="fw-normal py-0 my-0 d-flex align-items-center gap-1">
                                        {{ $item->roles }}
                                    </h6>
                                </div>
                            </td>
                            <td>
                                <div class="email-info">
                                    <h6 class="text-color fw-normal py-0 my-0">{{ $item->email }}</h6>
                                </div>
                            </td>
                            <td>
                                <div class="status-info">
                                    <h6 class="fw-normal py-0 my-0 {{ $item->status === 'banned' ? 'text-danger' : 'text-color' }}">
                                        {{ $item->status }}
                                    </h6>
                                </div>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="#"
                                        onclick="editUser('{{ $item->id }}', '{{ $item->avatar }}', '{{ $item->avatar_google }}', '{{ $item->status }}', '{{ $item->roles }}', '{{ $item->name }}', '{{ $item->email }}', '{{ $item->password }}')"
                                        data-bs-toggle="modal" data-bs-target="#edit-user-modal" title="Edit">
                                        <i class='bx bxs-pencil text-light'></i>
                                    </a>

                                    <form id="delete-user-form-{{ $item->id }}"
                                        action="{{ route('admin.destroy', $item->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="hapus-btn"
                                            onclick="confirmDeleteUser({{ $item->id }})">
                                            <i class='bx bxs-trash-alt text-danger'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah User -->
    <div class="modal fade" id="tambah-user-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-body-dark">
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-content">
                    <div class="modal-header mb-0 pb-0 border-0 d-flex align-items-center justify-content-between">
                        <h5 class="modal-title" id="tambah-user-label">Create user</h5>
                        <div class="close-btn" data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer;">
                            <i class='bx bx-x text-color fs-2 icon'></i>
                        </div>
                    </div>
                    <div class="modal-body">
                        <figure class="profile d-flex flex-column justify-content-center align-items-center gap-3 mb-4">
                            <div class="foto-profile">
                                <img id="img-avatar-tambah" class="img img-avatar" src="{{ asset('assets/images/avatar.jpg') }}">
                            </div>
                        </figure>

                        <label for="upload-foto-tambah" class="mt-3 mb-2">Upload Avatar (jpg, jpeg, png, and webp)</label>
                        <input type="file" class="form-control upload-avatar" name="avatar"
                            accept=".jpg, .jpeg, .png" id="upload-foto-tambah">

                        <label for="roles-tambah" class="mt-3">Roles</label>
                        <select id="roles-tambah" name="roles" class="form-select"
                            aria-label="Default select example">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>

                        <label for="username-tambah" class="mt-3">Username</label>
                        <input type="text" class="form-control" name="name" id="username-tambah"
                            value="{{ old('name') }}" placeholder="Enter Username" autocomplete="off" required>

                        <label for="email-tambah" class="mt-3">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="email-tambah" placeholder="Enter Email" autocomplete="off" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="password-tambah" class="mt-3">Password</label>
                        <div class="content-tambah-user" id="content-tambah-password">
                            <input type="password" class="form-control" name="password" id="password-tambah"
                                placeholder="Enter password" autocomplete="off" required>
                            <div class="pass-logo-pass" style="background-color: transparent;">
                                <div class="showPass" id="showPassTambah" style="display: none;">
                                    <i class="fa-regular fa-eye-slash"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary px-4" id="tambah-user-btn">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Tambah User -->

    <!-- Modal Edit User -->
    <div class="modal fade" id="edit-user-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-body-dark">
            <div class="modal-content">
                <div class="modal-header mb-0 pb-0 border-0 d-flex align-items-center justify-content-between">
                    <h5 class="modal-title" id="edit-user-label">Edit User</h5>
                    <div class="close-btn" data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer;">
                        <i class='bx bx-x fs-2 text-color icon'></i>
                    </div>
                </div>

                <div class="reset-btn">
                    <form id="reset-avatar-form" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" id="reset-avatar-btn">Delete</button>
                    </form>
                </div>

                <form id="edit-user-form" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="modal-body">
                        <figure class="profile d-flex flex-column justify-content-center align-items-center gap-3 mb-4">
                            <div class="foto-profile">
                                <img id="img-avatar" class="img img-avatar" src="">
                            </div>
                        </figure>

                        <label for="upload-foto" class="mt-3 mb-2">Upload Avatar (jpg, jpeg, png, and webp)</label>
                        <input type="file" class="form-control upload-avatar" name="avatar"
                            accept=".jpg, .jpeg, .png" id="upload-foto">

                        <div class="select-container d-flex align-items-center gap-2 w-100">
                            <div class="edit-status-container w-100">
                                <label for="edit-status" class="mt-3 mb-2">Status</label>
                                <select id="edit-status" name="status" class="form-select"
                                    aria-label="Default select example">
                                    <option value="approved">Approved</option>
                                    <option value="banned">Banned</option>
                                </select>
                            </div>

                            <div class="edit-roles-container w-100">
                                <label for="edit-roles" class="mt-3 mb-2">Roles</label>
                                <select id="edit-roles" name="roles" class="form-select"
                                    aria-label="Default select example">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>

                        <label for="edit-name" class="mt-3 mb-2">Username</label>
                        <input type="text" id="edit-name" class="form-control" name="name"
                            placeholder="Enter Username" autocomplete="off" required>

                        <label for="edit-email" class="mt-3 mb-2">Email</label>
                        <input type="email" id="edit-email" class="form-control" name="email"
                            placeholder="Enter Email" autocomplete="off" required>

                        <label for="edit-password" class="mt-3 mb-2">Change password</label>
                        <input type="password" id="edit-password" class="form-control" name="password"
                            placeholder="Enter password" autocomplete="off">
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" id="edit-user-btn" class="btn btn-primary px-4">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit User End -->
@endsection

@push('scripts')
    <!-- Datatables Js -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <script>
        $(document).ready(function() {
            $('#myDataTable').DataTable();

            // Toast
            if ("{{ session()->has('success') }}") {
                // Tampilkan toast
                $('#toast-success-content').toast('show');
            }
        });
        $('#myDataTable').DataTable({
            "language": {
                "searchPlaceholder": "Search users..."
            }
        });

        function editUser(id, avatar, avatar_google, status, roles, name, email) {
            var avatarUrl = avatar ? '{{ asset('storage/avatars/') }}/' + avatar :
                (avatar_google ? avatar_google : "https://ui-avatars.com/api/?background=random&name=" + encodeURIComponent(
                    name));

            $('#img-avatar').attr('src', avatarUrl);
            $('#edit-avatar-input').val('');
            $('#edit-status').val(status);
            $('#edit-roles').val(roles);
            $('#edit-name').val(name);
            $('#edit-email').val(email);
            $('#edit-password').val('');

            $('#reset-avatar-form').attr('action', "{{ route('admin.delete.avatar', '') }}" + '/' + id);
            $('#edit-user-form').attr('action', "{{ route('admin.update', '') }}" + '/' + id);
            $('#edit-user-modal').modal('show');
        }

        function confirmDeleteUser(userId) {
            Swal.fire({
                icon: 'question',
                title: 'Are you sure?',
                text: 'Are you sure you want to delete this account?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                customClass: {
                    popup: 'bg-modal',
                    title: 'text-color',
                    htmlContainer: 'text-color fw-normal',
                    icon: 'border-primary primary-color',
                    closeButton: 'bg-secondary border-0 shadow-none',
                    confirmButton: 'bg-danger border-0 shadow-none',
                },
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-user-form-' + userId).submit();
                }
            });
        }
    </script>
@endpush

