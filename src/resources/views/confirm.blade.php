@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>
    <form  class="form" action="/thanks" method="POST">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <!-- お名前 -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <input type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly />
                        <span>&nbsp;</span>
                        <input type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly />
                    </td>
                </tr>
                <!-- 性別 -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
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
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
                <input type="text" name="genderLabel" value="{{ $genderLabel }}" readonly />
                    </td>
                </tr>
                <!-- メールアドレス -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="text" name="email" value="{{ $contact['email'] }}" readonly />
                    </td>
                </tr>
                <!-- 電話番号 -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <input type="text" name="tel" value= "{{ $contact['tel_part1'] . $contact['tel_part2'] . $contact['tel_part3'] }}" readonly />
                    </td>
                </tr>
                <!-- 住所 -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address" value="{{ $contact['address'] }}"  readonly />
                    </td>
                </tr>
                <!-- 建物名 -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="building" value="{{ $contact['building'] }}"  readonly />
                    </td>
                </tr>
                <!-- お問い合わせの種類 -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />
                        @php
                            $category = $categories->firstWhere('id', $contact['category_id']);
                        @endphp
                        <input type="text" name="content" value="{{ $category->content }}" readonly />
                    </td>
                </tr>
                <!-- お問い合わせ内容 -->
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">送信</button>
            <button class="form__button-submit" type="button" onclick="window.history.back();">修正</button>
        </div>
    </form>
</div>
@endsection