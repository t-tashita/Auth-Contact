@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('authentication')
<div class="logout__link">
    <a class="logout__button-submit" href="/">Logout</a>
</div>
@endsection

@section('content')
<div class="contact-table">
  <div class="confirm__heading">
    <h2>Admin</h2>
  </div>
  <form class="search-form" action="/admin" method="post">
    @csrf
    <div class="search-form__item">
      <input class="search-form__item-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}">
      <select class="search-form__item-select-gender" name="gender">
        <option value="" disabled selected>性別</option>
        <option value="" >全て</option>
        <option value="1">男性</option>
        <option value="2">女性</option>
        <option value="3">その他</option>
      </select>
      <select class="search-form__item-select-category" name="category_id">
        <option disabled selected>お問い合わせの種類</option>
        @foreach ($categories as $category)
        <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
        @endforeach
      </select>
      <input type="date" class="search-form__item-date" id="date" name="date" value="{{ old('date') }}">
      <button class="search-form__button-submit" type="submit">検索</button>
      <button class="search-form__button-reset" type="reset">リセット</button>
    </div>
  </form>
    <table class="contact-table__inner">
      <tr class="contact-table__row">
          <th class="contact-table__header-span">お名前</th>
          <th class="contact-table__header-span">性別</th>
          <th class="contact-table__header-span">メールアドレス</th>
          <th class="contact-table__header-span">お問い合わせの種類</th>
          <th class="contact-table__header-span"></th>
      </tr>
      {{ $contacts->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
      @foreach ($contacts as $contact)
      <tr class="contact-table__row">
          <td class="contact-form__item">{{ $contact->first_name . ' ' . $contact->last_name }}</td>
          <td class="contact-form__item">
            @php
              $genderLabel = '';
              switch ($contact['gender']) {
                case '1':
                  $genderLabel = '男性';
                  break;
                case '2':
                  $genderLabel = '女性';
                  break;
                case '3':
                  $genderLabel = 'その他';
                  break;
              }
            @endphp
            {{ $genderLabel }}
          </td>
          <td class="contact-form__item">{{ $contact->email }}</td>
          <td class="contact-form__item">
              <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />
              @php
                  $category = $categories->firstWhere('id', $contact['category_id']);
              @endphp
              {{ $category->content }}
          </td>
        <td class="contact-table__item">
          <form class="detail-form" action="/admin/delete" method="get">
            @method('DETAIL')
            @csrf
            <!-- 詳細ボタン -->
              <button class="contact-form__button-detail"
                      data-bs-toggle="modal"
                      data-bs-target="#detailModal"
                      data-name="{{ $contact->first_name }} {{ $contact->last_name }}"
                      data-gender="{{ $genderLabel }}"
                      data-email="{{ $contact->email }}"
                      data-category="{{ $category->content }}"
                      data-message="{{ $contact->message }}">
                詳細
              </button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection