<x-slot name="header">
    <h1 class="font-bold text-center">Artist Mini Profile</h1>
</x-slot>
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="px-4 py-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
            @if (session()->has('message'))
            <div class="px-4 py-3 my-3 text-teal-900 bg-teal-100 border-t-4 border-teal-500 rounded-b shadow-md"
                role="alert">
                <div class="flex">
                    <div class="">
                        <p class="text-sm">{{ session()->get('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            <button wire:click="create()"
                class="inline-flex justify-center px-4 py-2 my-4 text-base font-bold text-white bg-red-500 border border-transparent rounded-md shadow-sm w-75 hover:bg-red-800">
                Add Artist
            </button>
            @if ($isModalOpen)
            @include('livewire.create')
            @endif
            <table class="w-full table-fixed">
                <thead>
                    <tr class="bg-blue-200">
                        <th class="w-20 px-3 py-2">No.</th>
                        <th class="px-3 py-2">Name</th>
                        <th class="px-3 py-2">Age</th>
                        <th class="px-3 py-2">Industry</th>
                        <th class="px-3 py-2">Company</th>
                        <th class="px-3 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($artists as $artist)
                    <tr>
                        <td class="px-3 py-2 border">{{ $artist->id }}</td>
                        <td class="px-3 py-2 border">{{ $artist->name }}</td>
                        <td class="px-3 py-2 border">{{ $artist->age }}</td>
                        <td class="px-3 py-2 border">{{ $artist->industry }}</td>
                        <td class="px-3 py-2 border">{{ $artist->company }}</td>
                        <td class="flex justify-center gap-4 px-3 py-2 border">
                            <button wire:click="edit({{ $artist->id }})"
                                class="px-4 py-2 text-white bg-indigo-500 rounded-lg cursor-pointer">Edit</button>
                            <button wire:click="delete({{ $artist->id }})"
                                class="px-4 py-2 text-white bg-red-500 rounded-lg cursor-pointer">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @push('script')
    <script>
        $(document).ready(function() {
            $('.industry-multiple').select2();
        });
    </script>
    @endpush
</div>
