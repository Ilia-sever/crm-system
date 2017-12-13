@if ($data['object']->transactions) 
    <div class="object-field">
        <label>{{trans('strings.fields-name.transactions')}}</label>
        <ul class="text-info text-info_full">
            @foreach ($data['object']->transactions as $transaction)
            @if (auth()->user()->can('watch','transactions',$transaction))
            <li>
                <a href="/transactions/show/{{$transaction->id}}">[{{$transaction->formated_datetimeof}}] {{$transaction->type->name}} - {{$transaction->formated_sum}}</a>
            </li>
            @endif
            @endforeach
        </ul>
        <a class="out-link" href="/transactions?search-field=assignment&&search-value={{$data['object']->name}}">{{trans('strings.operations.watch-other')}}</a>
    </div>
@endif