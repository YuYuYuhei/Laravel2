@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row">
        <div class="profile_headline mx-auto">
            <h2>この記事を書いたのはこの方！！</h2>
        </div>
        <hr color="#c0c0c0">
        @foreach($profiles as $profile)
        <div class="row">
            <div class="col-md-9 mx-auto mt-3">
                <p>名前(name)：{{ str_limit($profile->name, 15) }}</p>
                <p>性別(gender)：{{ str_limit($profile->gender, 5) }}</p>
                <p>趣味(hobby)：{{ str_limit($profile->hobby, 50) }}</p>
            </div>
            <div class="body ml-2">
                 <p>自己紹介(introduction)：</p>
                 <p>{{ str_limit($profile->introduction, 1500) }}</p>
            </div>
            <hr color="#c0c0c0">
        </div>
        @endforeach
    </div>
</div>
@endsection
