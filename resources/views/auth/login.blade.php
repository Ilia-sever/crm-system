@include ('layouts.header')
<div class="auth-wrapper">
<form class="auth-form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <span class="auth-form__title">{{trans('strings.modules.auth')}}</span>
    <span class="auth-form__caption">{{trans('strings.messages.auth')}}</span>

    @include ('layouts.errors')

    <div class="form-group">
        <label for="email">{{trans('strings.fields-name.email')}}</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus> 
    </div>
    <div class="form-group">
        <label for="password">{{trans('strings.fields-name.password')}}</label>
        <input id="password" type="password" class="form-control" name="password" required> 
    </div>
    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" {{ old( 'remember') ? 'checked' : '' }}> {{trans('strings.fields-name.remember-me')}}
            </label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary auth-form__button">{{trans('strings.operations.login')}}</button>
</form>
</div>
@include ('layouts.footer')