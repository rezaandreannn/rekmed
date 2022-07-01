<x-app-layout>

    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
            My Profile
        </a>
        <a href="#" class="list-group-item list-group-item-action">{{ $user->name }}</a>
        <a href="#" class="list-group-item list-group-item-action">{{ $user->email }}</a>
        <a href="#" class="list-group-item list-group-item-action">{{ $user->role->deskripsi }}.</a>
        {{-- <a class="list-group-item list-group-item-action disabled">A disabled link item</a> --}}
    </div>

</x-app-layout>
