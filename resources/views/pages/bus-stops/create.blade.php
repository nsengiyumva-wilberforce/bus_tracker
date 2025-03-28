<x-app-layout>
    <div class="container-fluid py-2">
        <div class="card-header bg-primary text-light">Add Bus Stop</div>
        <div class="card-body">
            <a href="{{ url('/bus-stops') }}" title="Back"><button class="button2"><i class="fa fa-arrow-left"
                        aria-hidden="true"></i> Back</button></a>
            <br />
            <br />
            <form method="POST" action="{{ url('/bus-stops') }}" accept-charset="UTF-8" class="form-horizontal"
                enctype="multipart/form-data">
                @csrf
                @include ('pages.bus-stops.form', ['formMode' => 'create'])

            </form>

        </div>
    </div>
</x-app-layout>
