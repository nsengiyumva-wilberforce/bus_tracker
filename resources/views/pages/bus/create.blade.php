<x-app-layout>
    <div class="container-fluid py-2">        
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">Add Bus</div>
                    <div class="card-body">
                        <a href="{{ url('/buses') }}" title="Back"><button class="button2"><i
                                    class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                        <form method="POST" action="{{ url('/buses') }}" accept-charset="UTF-8"
                            class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @include ('pages.bus.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
