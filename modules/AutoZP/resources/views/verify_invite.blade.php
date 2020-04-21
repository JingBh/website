@extends("autozp::layouts.layout")

@section("title", "验证邀请码")

@section("content")
    <div class="container my-5 text-center">
        <h1 class="mb-5">@component("autozp::components.logo")@endcomponent</h1>
        <div class="row justify-content-center">
            <div class="col-10 col-sm-7 col-md-5 col-lg-3">
                <div class="form-group">
                    <label for="inputInviteCode">邀请码</label>
                    <input type="text" class="form-control" id="inputInviteCode" placeholder="请输入邀请码">
                    <div class="invalid-feedback" id="invalidInviteCode">邀请码无效，请检查输入是否正确。</div>
                </div>
                <button class="btn btn-primary btn-block" id="submitInviteCode">提交</button>
            </div>
        </div>
    </div>
@endsection

@section("bodyjs")
    <script src="{{ asset(mix("js/verify_invite.js", "vendor/jingbh/autozp")) }}"></script>
@endsection
