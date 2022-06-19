<x-app-layout title="role">

    {{-- <div class="alert alert-primary" role="alert">
        A simple primary alert—check it out!
    </div> --}}

    <table class="table bg-white shadow-sm">
        <h5>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRole">Tambah role</a>
        </h5>
        <thead class="bg-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Role</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->deskripsi }}</td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm text-white" data-bs-toggle="modal"
                            data-bs-target="#updateRole{{ $role->id }}">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm text-white" data-bs-toggle="modal"
                            data-bs-target="#deleteRole{{ $role->id }}">Hapus</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Data tidak ada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    <!-- add role Modal -->
    <div class="modal fade" id="addRole" tabindex="-1" aria-labelledby="addRoleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleLabel">Tambah role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <x-input field="name" label="Name" value="{{ old('name'), $role->name }}"
                            placeholder="Superadmin" />
                        <x-input field="deskripsi" label="Deskripsi" value="{{ old('deskripsi'), $role->name }}"
                            placeholder="bisa akses semua menu" />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- update role modal --}}
    @foreach ($roles as $role)
        <div class="modal fade" id="updateRole{{ $role->id }}" tabindex="-1" aria-labelledby="updateRoleLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateRoleLabel">Ubah role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('roles.update', $role->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <x-input field="name" label="Name" value="{{ $role->name }}" />
                            <x-input field="deskripsi" label="Deskripsi" value="{{ $role->deskripsi }}" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    {{-- delete role modal --}}
    @foreach ($roles as $role)
        <div class="modal fade" id="deleteRole{{ $role->id }}" tabindex="-1" aria-labelledby="deleteRoleLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteRoleLabel">Hapus role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Yakin menghapus role "{{ $role->name }}" ?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm text-white">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
        {{-- sukses --}}
        @if (session('message'))
            <script>
                toastr.success("{{ session('message') }}");
            </script>
        @endif

        {{-- error validasi --}}
        @error('name')
            <script>
                toastr.error("{{ $message }}");
            </script>
        @enderror
        @error('deskripsi')
            <script>
                toastr.error("{{ $message }}");
            </script>
        @enderror
    @endpush

</x-app-layout>
