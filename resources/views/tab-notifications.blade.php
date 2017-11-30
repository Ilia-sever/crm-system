@foreach ($data['notifications'] as $notification)
<div class="notification @if ($notification['viewed'] == '1') notification_old @endif">
	<span class="notification__date">{{$notification->formated_datetimeof}}</span>
	<span class="notification__title">{{$notification->title}}</span>
	<p class="notification__text">{{$notification->text}}</p>
	<a href="{{$notification->link}}" class="notification__link">{{trans('strings.operations.detail')}}</a>
</div>
<hr>
@endforeach