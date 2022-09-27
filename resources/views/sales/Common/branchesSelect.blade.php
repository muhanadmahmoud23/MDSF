<select class="selectpicker" multiple data-live-search="true" name="multiple" id="BranchAjax"
data-actions-box="true">
@foreach ($branches as $branch)
    <option value="{{ $branch->branch_code }}" name="multiple_select" id="BranchAjax">
        {{ $branch->branch_name }}</option>
@endforeach
</select>