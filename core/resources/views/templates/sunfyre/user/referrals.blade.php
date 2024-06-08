@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row">
        @if (auth()->user()->referrer)
            <h4 class="mb-2">@lang('You are referred by') {{ auth()->user()->referrer->fullname }}</h4>
        @endif
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <input class="form-control form--control referralURL" type="text" value="{{ route('home') }}?reference={{ auth()->user()->username }}" readonly>
                    <button class="input-group-text copytext" id="copyBoard" type="button"><i class="fas fa-copy"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card custom--card">
                <div class="card-body">
                    @if ($user->allReferrals->count() > 0 && $maxLevel > 0)
                        <div class="treeview-container">
                            <ul class="treeview">
                                <li class="items-expanded"> {{ $user->fullname }} ( {{ $user->username }} )
                                    @include($activeTemplate . 'partials.under_tree', ['user' => $user, 'layer' => 0, 'isFirst' => true])
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="text-center">
                            <h5>{{ __($emptyMessage) }}</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style-lib')
    <link type="text/css" href="{{ asset('assets/global/css/jquery.treeView.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/jquery.treeView.js') }}"></script>
@endpush

@push('style')
    <style type="text/css">
        @media (max-width: 425px) {
            .input-group-text {
                height: 49px;
            }
        }

        .copied::after {
            background-color: #{{ gs('base_color') }}
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.treeview').treeView();

            $('#copyBoard').click(function() {
                var copyText = document.getElementsByClassName("referralURL");
                copyText = copyText[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                /*For mobile devices*/
                document.execCommand("copy");
                copyText.blur();
                this.classList.add('copied');
                setTimeout(() => this.classList.remove('copied'), 1500);
            });
        })(jQuery);
    </script>
@endpush
