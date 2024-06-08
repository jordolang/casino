@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="py-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        @php
                            echo $cookie->data_values->description;
                        @endphp
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
