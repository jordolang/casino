@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card custom--card">
                <div class="card-body">
                    <form class="register" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('First Name')</label>
                                    <input type="text" class="form--control" name="firstname" value="{{ $user->firstname }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Last Name')</label>
                                    <input type="text" class="form--control" name="lastname" value="{{ $user->lastname }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('E-mail Address')</label>
                                    <input class="form--control" value="{{ $user->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Mobile Number')</label>
                                    <input class="form--control" value="{{ $user->mobile }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Address')</label>
                                    <input type="text" class="form--control" name="address" value="{{ @$user->address }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('State')</label>
                                    <input type="text" class="form--control" name="state" value="{{ @$user->state }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('Zip Code')</label>
                                    <input type="text" class="form--control" name="zip" value="{{ @$user->zip }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('City')</label>
                                    <input type="text" class="form--control" name="city" value="{{ @$user->city }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('Country')</label>
                                    <input class="form--control" value="{{ @$user->country_name }}" disabled>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
