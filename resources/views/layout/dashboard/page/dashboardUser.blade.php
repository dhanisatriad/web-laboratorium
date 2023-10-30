@extends('layout.dashboard.template')
@section('contents')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mb-5">
                @if (session()->has('success'))
                    <div class="alert alert-primary alert-dismissible fade show my-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->any())
                    {!! implode(
                        '',
                        $errors->all(' <div class="alert alert-danger my-3 alert-dismissible fade show" role="alert">:message<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>'),
                    ) !!}
                @endif
                <div class="d-flex justify-content-center ">
                    <div class="card my-4 shadow col-lg-6 col-12 ">
                        <div class="card-header text-white bg-primary fs-4">
                            <i class="fas fa-table me-1"></i>
                            Data User
                        </div>
                        <div class="card-body">
                            <div class=" mb-4">
                                <div class="card shadow  py-2">
                                    <div class="card-body">
                                        <form id="form" method="post"
                                            action="{{ route('daftar-user.update', $user->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <label for="level" class="col-3 col-form-label">Level</label>
                                                <div class="col-9">
                                                    @if (auth()->user()->level == "Admin")
                                                        <select class="form-select" id="level" name="level"
                                                            @if ($user->level == 'Admin' && $jAdmin <= 1) {{ 'disabled' }} @endif>
                                                            <option value="Admin"
                                                                @if ($user->level == 'Admin') {{ 'selected' }} @endif>
                                                                Admin</option>
                                                            <option value="Operator"
                                                                @if ($user->level == 'Operator') {{ 'selected' }} @endif>
                                                                Operator</option>
                                                        </select>
                                                        @if ($user->level == 'Admin' && $jAdmin <= 1)
                                                        <input type="hidden" name="level" value="{{ $user->level }}"
                                                        readonly>
                                                        @endif
                                                    @else
                                                    <input type="text" class="form-control" name="level" id="level"
                                                        value="{{ $user->level }}" maxlength="255" readonly>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="name" class="col-3 col-form-label">Nama User</label>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        value="{{ $user->name }}" maxlength="255"
                                                        @if (auth()->user()->id !== $user->id) {{ 'disabled' }} @endif>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="email" class="col-3 col-form-label">Email</label>
                                                <div class="col-9">
                                                    <input type="email" class="form-control" name="email" id="email"
                                                        value="{{ $user->email }}" maxlength="255"
                                                        @if (auth()->user()->id !== $user->id) {{ 'disabled' }} @endif>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary"
                                                @if (auth()->user()->id !== $user->id && auth()->user()->level !== 'Admin') {{ 'disabled' }} @endif>Update</button>
                                        </form>
                                        @if ($user->level !== 'Admin' || $jAdmin > 1)
                                            <button class="delete-user btn btn-danger mt-1" data-id="{{ $user->id }}"
                                                @if (auth()->user()->id !== $user->id && auth()->user()->level !== 'Admin') {{ 'disabled' }} @endif><i
                                                    class="fa-solid
                                                    fa-trash"></i>
                                                Hapus User</button>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="hapusUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-light">
                            <h5 class="modal-title" id="staticBackdropLabel">Hapus user
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Hapus data user?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <form action="{{ route('daftar-user.destroy', $user->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn bg-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function() {
            $(".delete-user").click(function() {
                $('#hapusUser').modal('show');
            });
        });
    </script>
@endsection
