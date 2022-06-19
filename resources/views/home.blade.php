<x-app-layout title='Home'>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ auth()->user()->role->name }}
                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
