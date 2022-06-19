<x-app-layout>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $user->email }}</h6>
            <p class="card-text">{{ $user->role->deskripsi }}.</p>
            {{-- <a href="#" class="tex">Card link</a> --}}
            {{-- <a href="" class="card-link">Another link</a> --}}
        </div>
    </div>
</x-app-layout>
