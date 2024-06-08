@if (gs('multi_language'))
    @php
        $languages = App\Models\Language::get();
        $language = $languages->where('code', '!=', session('lang'));
        $activeLanguage = $languages->where('code', session('lang'))->first();
    @endphp
    <li class="{{ $class }}">
        <div class="language dropdown">
            <button class="language-wrapper" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="language-content">
                    <div class="language_flag">
                        <img src="{{ getImage(getFilePath('language') . '/' . @$activeLanguage->image, getFileSize('language')) }}" alt="flag">
                    </div>
                    <p class="language_text_select">{{ __(@$activeLanguage->name) }}</p>
                </div>
                <span class="collapse-icon"><i class="las la-angle-down"></i></span>
            </button>
            <div class="dropdown-menu langList_dropdow py-2" style="">
                <ul class="langList">
                    @foreach ($language as $item)
                        <li class="language-list langSel" data-lang_code="{{ $item->code }}">
                            <div class="language_flag">
                                <img src="{{ getImage(getFilePath('language') . '/' . @$item->image, getFileSize('language')) }}" alt="flag">
                            </div>
                            <p class="language_text">{{ __(@$item->name) }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </li>
@endif

@push('script')
    <script>
        $(document).ready(function() {
            const $mainlangList = $(".langList");
            const $langBtn = $(".language-content");
            const $langListItem = $mainlangList.children();

            $langListItem.each(function() {
                const $innerItem = $(this);
                const $languageText = $innerItem.find(".language_text");
                const $languageFlag = $innerItem.find(".language_flag");

                $innerItem.on("click", function(e) {
                    $langBtn.find(".language_text_select").text($languageText.text());
                    $langBtn.find(".language_flag").html($languageFlag.html());
                });
            });
        });
    </script>
@endpush

@push('style')
    <style>
        .language-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 0;
            border-radius: 4px;
            width: max-content;
            height: 38px;
        }

        .language_flag {
            flex-shrink: 0
        }

        .language_flag img {
            height: 30px;
            width: 30px;
            object-fit: cover;
            border-radius: 50%;
        }

        .language-wrapper.show .collapse-icon {
            transform: rotate(180deg)
        }

        .collapse-icon {
            font-size: 14px;
            display: flex;
            transition: all linear 0.2s;
            color: hsl(var(--white));
        }

        .language_text_select {
            font-weight: 600 !important;
            font-family: var(--heading-font);
            font-size: 22px !important;
            color: hsl(var(--white));
        }

        .language-content {
            display: flex;
            align-items: center;
            gap: 6px;
        }


        .language_text {
            color: #ffffff;
            padding: 0 !important;
            line-height: 1.75rem;
        }

        .language-list {
            display: flex;
            align-items: center;
            gap: 12px !important;
            padding: 6px 12px;
            cursor: pointer;
        }

        .language-list .language_flag img {
            height: 20px;
            width: 20px;
        }

        .language .dropdown-menu {
            position: absolute;
            -webkit-transition: ease-in-out 0.1s;
            transition: ease-in-out 0.1s;
            opacity: 0;
            visibility: hidden;
            top: 100%;
            display: unset;
            background: #2a313b;
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
            width: max-content;
            padding: 7px 0 !important;
            border-radius: 8px;
            border: 1px solid rgb(255 255 255 / 10%);
        }

        .language .dropdown-menu.show {
            visibility: visible;
            opacity: 1;
        }
    </style>
@endpush
