@extends('admin.layouts.app')
@section('panel')
@push('topBar')
  @include('admin.notification.top_bar')
@endpush
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card bl--5 border--primary">
            <div class="card-body">
                <p class="text--primary">@lang('If you want to send push notification by the firebase, Your system must be SSL certified')</p>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <form action="#" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('API Key') </label>
                                <input type="text" class="form-control" placeholder="@lang('API Key')" name="apiKey" value="{{ @gs('firebase_config')->apiKey }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('Auth Domain') </label>
                                <input type="text" class="form-control" placeholder="@lang('Auth Domain')" name="authDomain" value="{{ @gs('firebase_config')->authDomain }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('Project Id') </label>
                                <input type="text" class="form-control" placeholder="@lang('Project Id')" name="projectId" value="{{ @gs('firebase_config')->projectId }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('Storage Bucket') </label>
                                <input type="text" class="form-control" placeholder="@lang('Storage Bucket')" name="storageBucket" value="{{ @gs('firebase_config')->storageBucket }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('Messaging Sender Id') </label>
                                <input type="text" class="form-control" placeholder="@lang('Messaging Sender Id')" name="messagingSenderId" value="{{ @gs('firebase_config')->messagingSenderId }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('App Id') </label>
                                <input type="text" class="form-control" placeholder="@lang('App Id')" name="appId" value="{{ @gs('firebase_config')->appId }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('Measurement Id') </label>
                                <input type="text" class="form-control" placeholder="@lang('Measurement Id')" name="measurementId" value="{{ @gs('firebase_config')->measurementId }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('Server key') </label>
                                <input type="text" class="form-control" placeholder="@lang('Server key')" name="serverKey" value="{{ @gs('firebase_config')->serverKey }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                </div>
            </form>
        </div><!-- card end -->
    </div>
</div>

<div id="pushNotifyModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Firebase Setup')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="steps-tab" data-bs-toggle="tab" data-bs-target="#steps" type="button" role="tab" aria-controls="steps" aria-selected="true">@lang('Steps')</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="configs-tab" data-bs-toggle="tab" data-bs-target="#configs" type="button" role="tab" aria-controls="configs" aria-selected="false">@lang('Configs')</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="server-tab" data-bs-toggle="tab" data-bs-target="#server" type="button" role="tab" aria-controls="server" aria-selected="false">@lang('Server Key')</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="steps" role="tabpanel" aria-labelledby="steps-tab">
                        <div class="table-responsive overflow-hidden">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>@lang('To Do')</th>
                                        <th>@lang('Description')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>@lang('Step 1')</td>
                                    <td>@lang('Go to your Firebase account and select') <span class="text--primary">"@lang('Go to console')</span>" @lang('in the upper-right corner of the page.')</td>
                                </tr>
                                <tr>
                                    <td>@lang('Step 2')</td>
                                    <td>
                                        @lang('Select Add project and do the following to create your project.')
                                        <br>
                                        <code class="text--primary">
                                            @lang('Use the name, Enable Google Analytics, Choose a name and the country for Google Analytics, Use the default analytics settings')
                                        </code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('Step 3')</td>
                                    <td>@lang('Within your Firebase project, select the gear next to Project Overview and choose Project settings.')</td>
                                </tr>
                                <tr>
                                    <td>@lang('Step 4')</td>
                                    <td>@lang('Next, set up a web app under the General section of your project settings.')</td>
                                </tr>
                                <tr>
                                    <td>@lang('Step 5')</td>
                                    <td>@lang('Next, go to Cloud Messaging in your Firebase project settings and enable Cloud Messaging API.')</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade mt-3 ms-2 text-center" id="configs" role="tabpanel" aria-labelledby="configs-tab">
                        <img src="{{ getImage('assets/images/firebase/' .'configs.png') }}" alt="Firebase Config">
                    </div>
                    <div class="tab-pane fade mt-3 ms-2 text-center" id="server" role="tabpanel" aria-labelledby="server-tab">
                        <img src="{{ getImage('assets/images/firebase/' .'server.png') }}" alt="Firebase Server">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn--dark" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
    <button type="button" data-bs-target="#pushNotifyModal" data-bs-toggle="modal" class="btn btn-outline--info">
        <i class="las la-question"></i>@lang('Help')
    </button>
@endpush
