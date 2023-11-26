@extends('admin.layouts.admin')

@section('title', trans('communityanalytics::main.name'))

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ plugin_asset('communityanalytics', 'css/style.css') }}">
@endpush

@section('content')
  <div class="card shadow p-4">
    <div class="container">
      <!-- Informations -->
      <div class="mb-4">
        <h2 class="pb-2 border-bottom">
          <div class="d-flex flex-row align-items-center">
            <a href="https://communityanalytics.net/l/azuriom">
              <img src="{{ plugin_asset('communityanalytics', 'img/logos/main.svg') }}" class="w-16 m-4"
                   alt="CommunityAnalytics logo" data-bs-theme="light">
            </a>
            <h1 class="bold">
              CommunityAnalytics
            </h1>
          </div>
        </h2>

        <div class="row g-4 py-5 row-cols-1 row-cols-lg-4 border-bottom">
          @php
            $data = [
                [
                    'icon' => plugin_asset('communityanalytics', 'img/icons/marketing.png'),
                    'title' => trans('communityanalytics::main.cards.marketing.title'),
                    'message' => trans('communityanalytics::main.cards.marketing.message'),
                ],
                [
                    'icon' => plugin_asset('communityanalytics', 'img/icons/retention.png'),
                    'title' => trans('communityanalytics::main.cards.retention.title'),
                    'message' => trans('communityanalytics::main.cards.retention.message'),
                ],
                [
                    'icon' => plugin_asset('communityanalytics', 'img/icons/more-money.png'),
                    'title' => trans('communityanalytics::main.cards.more-money.title'),
                    'message' => trans('communityanalytics::main.cards.more-money.message'),
                ],
                [
                    'icon' => plugin_asset('communityanalytics', 'img/icons/competition.png'),
                    'title' => trans('communityanalytics::main.cards.competition.title'),
                    'message' => trans('communityanalytics::main.cards.competition.message'),
                ],
            ];
          @endphp
          @foreach ($data as $item)
            <div class="feature col">
              <div
                class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 p-2 rounded">
                <img src="{{ $item['icon'] }}" class="w-16" alt="Feature image">
              </div>
              <h3 class="fs-2 text-body-emphasis">{{ $item['title'] }}</h3>
              <p>{{ $item['message'] }}</p>
            </div>
          @endforeach
        </div>
      </div>

      <div class="alert alert-warning mb-4" role="alert">
        {{ trans('communityanalytics::main.admin.why-api-key') }}<br>
        {{ trans('communityanalytics::main.admin.go-add-store') }}
        <a href="https://communityanalytics.net/l/azuriom-store-add" class="underline my-0">
          {{ trans('communityanalytics::main.follow-link') }}
        </a>
      </div>

      <div class="grid gap-4 p-8">
        <!-- Api url -->
        <div class="mb-3">
          <label for="api_url" class="form-label">{{ trans('communityanalytics::main.admin.api-url') }}</label>
          <input id="api_url" type="text" class="form-control" name="api_url" disabled value="{{ route('home') }}">
        </div>

        <!-- Api key -->
        <div class="mb-3">
          <label for="api_token" class="form-label">{{ trans('communityanalytics::main.admin.api-key') }}</label>
          <input id="api_token" type="text" class="form-control" name="api_token" disabled value="{{ $api_key }}"/>
        </div>

        <!-- Regenerate -->
        <form action="{{ route('communityanalytics.admin.regenerate-api-key') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-warning flex gap-2 items-center">
            <i class="bi bi-save"></i> {{ trans('communityanalytics::main.admin.regenerate') }}
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection
