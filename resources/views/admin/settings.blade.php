@extends('admin.layouts.admin')

@section('title', trans('communityanalytics::admin.settings.title'))

@section('content')
    <div class="card shadow">
        <a href="https://communityanalytics.net">
            <img src="{{ plugin_asset('communityanalytics', 'img/logos/main-black.svg') }}"
                 class="p-4" alt="CommunityAnalytics logo" width="20%">
        </a>

        <div class="bg-main-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:max-w-none">
                    <div class="grid grid-cols-1 gap-0.5 rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-4">

                        <div class="bg-white p-8 space-y-2">
                            <div class="bg-main h-20 w-20 rounded flex items-center justify-center mx-auto">
                                <img src="" class="h-16 w-16" alt="Feature image">
                            </div>
                            <div class="order-first text-3xl font-semibold tracking-tight text-gray-900">Better marketing</div>
                            <div class="text-sm font-semibold leading-6 text-gray-600">Win new players more easily and more cheaply.</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('communityanalytics.admin.settings') }}" method="POST">
                @csrf
                <!-- Header -->
                <a href="https://communityanalytics.net">
                    <img src="{{ plugin_asset('communityanalytics', 'img/logos/main-black.svg') }}"
                         alt="Community Analytics logo" width="20%">
                </a>
                <p>{{ trans('communityanalytics::admin.settings.header')}}</p>

                <!-- Information on Community Analytics --
                <div class="text-center">
                    <a href="https://communityanalytics.net/demo">
                        <h2 class="text-primary">{{ trans('communityanalytics::admin.settings.tryNow') }}</h2>
                        <img src="{{ plugin_asset('communityanalytics', 'img/presentation/auth2.jpg') }}"
                             alt="Community Analytics logo" width="65%">
                    </a>
                    <p> {{ trans('communityanalytics::admin.settings.description') }}</p>
                </div>-->

                <!-- Api key field -->
                <div class="mb-3">
                    <label class="form-label" for="apiToken">{{ trans('communityanalytics::admin.settings.apiToken') }}
                        <a href="https://communityanalytics.net/platforms">{{ trans('communityanalytics::admin.settings.editPlatformPage') }}</a></label>
                    <input type="text" class="form-control @error('api_token') is-invalid @enderror" id="apiToken"
                           name="api_token" value="{{ old('api_token', setting('communityanalytics.api_token')) }}"
                           aria-describedby="apiTokenInfo">

                    @error('apiToken')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                    <small id="apiTokenInfo"
                           class="form-text">{{ trans('communityanalytics::admin.settings.apiTokenInfo') }}</small>
                </div>

                <!-- Save button -->
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection
