@extends('admin.layouts.admin')

@section('title', trans('community-analytics::admin.settings.title'))

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('community-analytics.admin.settings') }}" method="POST">
                @csrf
                <!-- Header -->
                <a href="https://communityanalytics.net">
                    <img src="{{ plugin_asset('community-analytics', 'img/logos/main-black.svg') }}"
                         alt="Community Analytics logo" width="20%">
                </a>
                <p>{{ trans('community-analytics::admin.settings.header')}}</p>

                <!-- Information on Community Analytics -->
                <div class="text-center">
                    <a href="https://communityanalytics.net/demo">
                        <h2 class="text-primary">{{ trans('community-analytics::admin.settings.tryNow') }}</h2>
                        <img src="{{ plugin_asset('community-analytics', 'img/presentation/auth2.jpg') }}"
                             alt="Community Analytics logo" width="65%">
                    </a>
                    <p> {{ trans('community-analytics::admin.settings.description') }}</p>
                </div>

                <!-- Api key field -->
                <div class="mb-3">
                    <label class="form-label" for="apiToken">{{ trans('community-analytics::admin.settings.apiToken') }}
                        <a href="https://communityanalytics.net/platforms">{{ trans('community-analytics::admin.settings.editPlatformPage') }}</a></label>
                    <input type="text" class="form-control @error('api_token') is-invalid @enderror" id="apiToken"
                           name="api_token" value="{{ old('api_token', setting('community-analytics.api_token')) }}"
                           aria-describedby="apiTokenInfo">

                    @error('apiToken')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                    <small id="apiTokenInfo"
                           class="form-text">{{ trans('community-analytics::admin.settings.apiTokenInfo') }}</small>
                </div>

                <!-- Save button -->
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection
