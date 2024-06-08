@props(['customModal' => '', 'baseBtn' => 'btn--primary', 'closeBtn' => 'btn--dark', 'sectionBg' => ''])
<div id="confirmationModal" class="modal {{ $customModal }} fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content {{ $sectionBg }}">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Confirmation Alert!')</h5>
                <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                    <i class="las la-times"></i>
                </span>
            </div>
            <form method="POST">
                @csrf
                <div class="modal-body">
                    <p class="question"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn {{ $closeBtn }}" data-bs-dismiss="modal" type="button">@lang('No')</button>
                    <button class="btn {{ $baseBtn }}" type="submit">@lang('Yes')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        (function($) {
            "use strict";
            $(document).on('click', '.confirmationBtn', function() {
                var modal = $('#confirmationModal');
                let data = $(this).data();
                modal.find('.question').text(`${data.question}`);
                modal.find('form').attr('action', `${data.action}`);
                if (data.modal_bg) {
                    modal.find('.modal-content').addClass(`${data.modal_bg}`);
                    modal.find('.submit-btn').addClass(`${data.btn_class}`);
                }
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
