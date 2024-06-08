@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card custom--card">
                <div class="card-body">
                    <form action="{{ route('user.kyc.submit') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row gy-2">
                            <x-viser-form identifier="act" identifierValue="kyc" />
                        </div>

                        <div class="form-group">
                            <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
