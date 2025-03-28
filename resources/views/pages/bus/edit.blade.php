<x-app-layout>
    <h5 class="text-center mt-5">Edit Bus Stop</h5>
    <div class="mt-3">
        <form method="POST" action="{{ route('buses.update', $bus->id) }}" accept-charset="UTF-8"
            class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include ('pages.bus.form', ['formMode' => 'edit'])
        </form>
    </div>
</x-app-layout>
