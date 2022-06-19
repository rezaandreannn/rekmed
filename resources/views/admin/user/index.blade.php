<x-app-layout title="User">

    <table class="table bg-white shadow-sm">
        <h5>
            <a href="{{ route('register') }}" class="btn btn-primary">Tambah User</a>
        </h5>
        <thead class="bg-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">email</th>
                <th scope="col">role</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><a href="#" class="btn btn-warning btn-sm text-white" data-bs-toggle="modal"
                            data-bs-target="#updateUser{{ $user->id }}">{{ $user->role->name }}</a></td>
                    <td>
                        <a href="#" class="btn btn-danger btn-sm text-white" data-bs-toggle="modal"
                            data-bs-target="#deleteUser{{ $user->id }}">Hapus</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Data tidak ada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    {{-- update users modal --}}
    @foreach ($users as $user)
        <div class="modal fade" id="updateUser{{ $user->id }}" tabindex="-1" aria-labelledby="updateUserLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateUserLabel">Ubah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.update', $user->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <x-select field="role" name="role_id">
                                @foreach ($roles as $role)
                                    @if ($user->role->id == $role->id)
                                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                    @else
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </x-select>
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


    {{-- delete user modal --}}
    @foreach ($users as $user)
        <div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUserLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteUserLabel">Hapus User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Yakin menghapus User Name "{{ $user->name }}" ?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post" class="d-inline">
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
