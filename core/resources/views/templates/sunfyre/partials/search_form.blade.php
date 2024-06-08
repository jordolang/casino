<div class="d-flex justify-content-end">
    <form>
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control form--control" name="search" value="{{ request()->search }}" placeholder="@lang('Search here...')">
                <button class="input-group-text" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
</div>
