@if (auth()->user()->can('setup_types','transactions'))
<div class="index-additional">
    <a href="/transactions/types/edit" class="icon-button icon-button_setup transaction-types">{{trans ('strings.operations.setup-transaction-types')}}</a>
</div>
@endif