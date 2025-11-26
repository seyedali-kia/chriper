
<x-layout :hideButton="true">
    <x-slot:title>
        Upload Profile
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Edit Chirp</h1>

        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-control w-full">
                        <input class="btn btn-ghost btn-sm" type="file" name="image">
                        <button class="btn btn-ghost btn-sm" type="submit">upload</button>
                    </div>
                </form>
                @foreach ($errors->all() as $error)
                    <div class="label">
                        <span class="label-text-alt text-error">{{ $error }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>