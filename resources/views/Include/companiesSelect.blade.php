<select class="selectpicker" multiple data-live-search="true" name="multiple" id="CompanyAjax"
data-actions-box="true">
@foreach ($companies as $company)
    <option value="{{ $company->company_id }}" name="multiple_select" id="CompanyAjax">
        {{ $company->company_name }}</option>
@endforeach
</select>