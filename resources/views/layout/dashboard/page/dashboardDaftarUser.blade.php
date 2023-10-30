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
                <div class="card my-4  shadow">
                    <div class="card-header text-white bg-primary fs-4">
                        <i class="fas fa-table me-1"></i>
                        Daftar User
                    </div>
                    <div class="card-body table-responsive">
                        @if ($users->count())
                            <table id="datatablesSimple"
                                class="table dataTable-table table-hover table-striped mt-2 rounded rounded-4 overflow-hidden">
                                <thead class="bg-primary fs-6">
                                    <tr class="text-white text-center">
                                        <th>No.</th>
                                        <th>Nama User</th>
                                        <th>Level</th>
                                        <th>Email</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="clickable-row text-center"
                                            data-href="{{ route('daftar-user.show', $user->id) }}" style="cursor: pointer">
                                            <td>
                                                {{ $loop->iteration }}</td>
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                            <td>
                                                {{ $user->level }}</td>

                                            <td>
                                                {{ $user->email }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $users->links() }}
                            </div>
                        @else
                            <p class="text-center fs-4">user kosong</p>
                        @endif
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
                            <button class="btn bg-danger" id="hapus"
                                data-url="{{ url('/dashboard/daftar-user/delete') }}">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function() {


            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            }).children('.delete').click(function(e) {
                return false;
            });
            $(".delete-permohonan").click(function() {
                var bruh = $(this).attr('data-id');
                $('#hapusUser').modal('show');
                $('#hapusUser').on('shown.bs.modal', function(event) {
                    $('#hapus').attr("data-id", bruh);
                });
            });

            $('#hapus').on('click', function(e) {
                var id = $(this).attr('data-id');
                if (id == '') {
                    alert("Please select row.");
                } else {
                    // console.log(id);
                    $.ajax({

                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'id=' + id,
                        success: function(data) {
                            if (data['success']) {
                                $(this).parents("tr").remove();
                                window.location = data.url;
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert(data);
                            }
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });
                }
            });

        });
    </script>
@endsection
