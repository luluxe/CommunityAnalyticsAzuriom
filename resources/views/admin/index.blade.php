@extends('admin.layouts.admin')

@section('title', trans('communityanalytics::main.name'))

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ plugin_asset('communityanalytics', 'css/style.css') }}">
@endpush

@section('content')
  <div class="card shadow">
    <a href="https://communityanalytics.net/l/azuriom" class="bg-white">
      <img src="{{ plugin_asset('communityanalytics', 'img/logos/main-black.svg') }}"
           class="p-4 w-96 mx-auto" alt="CommunityAnalytics logo">
    </a>

    <div class="mx-auto grid grid-cols-1 gap-0.5 rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-4">
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
        <div class="bg-main-white p-8 grid gap-2">
          <div class="bg-main h-20 w-20 rounded flex items-center justify-center mx-auto">
            <img src="{{ $item['icon'] }}" class="h-16 w-16" alt="Feature image">
          </div>
          <div class="text-3xl font-semibold tracking-tight text-gray-900">
            {{ $item['title'] }}
          </div>
          <div class="text-sm font-semibold leading-6 text-gray-600">
            {{ $item['message'] }}
          </div>
        </div>
      @endforeach
    </div>

    <div class="grid gap-4 p-8">
      <!-- Where find API KEY -->
      <div class="flex mx-auto">
        <div class="alert alert-dismissible alert-warning mb-0">
          {{ trans('communityanalytics::main.admin.why-api-key') }}<br>
          {{ trans('communityanalytics::main.admin.go-add-store') }}
          <a href="https://communityanalytics.net/l/azuriom-store-add" class="underline my-0">
            {{ trans('communityanalytics::main.follow-link') }}
          </a>
        </div>
      </div>

      <!-- Submit API KEY -->
      <div class="grid gap-4">
        <div class="form-group mx-auto">
          <label class="form-label" for="api_url">{{ trans('communityanalytics::main.admin.api-url') }}</label>
          <input type="text" class="form-control w-api-key" id="api_url" name="api_url" disabled
                 value="{{ route('communityanalytics.api.info') }}" style="margin-right:9rem;"/>
        </div>

        <div class="form-group mx-auto">
          <label class="form-label" for="api_token">{{ trans('communityanalytics::main.admin.api-key') }}</label>
          <div class="flex gap-4">
            <input type="text" class="form-control w-api-key" id="api_token" name="api_token" disabled
                   value="{{ $api_key }}"/>
            <form action="{{ route('communityanalytics.admin.regenerate-api-key') }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-warning flex gap-2 items-center">
                <i class="bi bi-save"></i> {{ trans('communityanalytics::main.admin.regenerate') }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
