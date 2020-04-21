@extends("autozp::layouts.layout")

@section("content")
    <div class="container my-3 mt-md-5">
        <div class="row">
            <div class="col-auto col-sm" id="logoSection">
                <h1 class="mb-1">@component("autozp::components.logo")@endcomponent</h1>
                <p class="mb-0">一个<span class="font-weight-light mx-1">极简</span>综评系统客户端</p>
            </div>
            <div class="col col-sm-5 col-md-4 col-lg-3 col-xl-2">
                <button class="btn btn-outline-primary btn-block mt-3" id="loginButton" data-toggle="modal" data-target="#loginModal" disabled="disabled">登录</button>
                <button class="btn btn-outline-danger btn-block mt-3 hide" id="logoutButton" disabled="disabled">登出</button>
            </div>
        </div>
        <hr>
        <p class="text-info" id="userInfoLoading">
            <span class="spinner-border spinner-border-sm"></span>
            正在加载用户信息...
        </p>
        <div class="hide" id="userInfo">
            <div class="media">
                <img class="mr-3" alt="综评系统默认头像" id="userAvatar">
                <div class="media-body">
                    <h3 class="my-0 font-weight-light" id="userName"></h3>
                    <p class="my-0" id="userSchool"></p>
                    <p class="my-0">分数：<span id="userScore"><span class="spinner-border spinner-border-sm text-primary"></span></span></p>
                </div>
            </div>
            <ul class="nav nav-tabs mt-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#recordsTabPanel" role="tab">记录</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#rankTabPanel" role="tab">排名</a>
                </li>
                <!--开发中
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#uploadTabPanel" role="tab">上传</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#planTabPanel" role="tab">计划</a>
                </li>-->
            </ul>
            <div class="tab-content mt-2">
                <div class="tab-pane fade show active" id="recordsTabPanel" role="tabpanel">
                    <p id="recordsLoading"><span class="spinner-border spinner-border-sm text-primary"></span> 正在加载，请稍候...</p>
                    <table class="table table-hover text-nowrap" id="recordsTable"></table>
                </div>
                <div class="tab-pane fade" id="rankTabPanel" role="tabpanel">
                    <p>您可以在这里查询同学们的分数和排名。</p>
                    <div class="form-group" id="switchRankGradeGroup">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="switchRankGrade">
                            <label class="custom-control-label" for="switchRankGrade">包含全年级同学</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="switchRankCustom">
                            <label class="custom-control-label" for="switchRankCustom">高级查询</label>
                        </div>
                    </div>
                    <div class="form-group mt-n3 hide" id="inputRankParamsGroup">
                        <div class="form-row">
                            <div class="col-4">
                                <label class="small text-muted" for="inputRankParam_orgId">orgId</label>
                                <input type="text" class="form-control form-control-sm" id="inputRankParam_orgId">
                            </div>
                            <div class="col-3">
                                <label class="small text-muted" for="inputRankParam_gradeId">gradeId</label>
                                <input type="text" class="form-control form-control-sm" id="inputRankParam_gradeId">
                            </div>
                            <div class="col-5">
                                <label class="small text-muted" for="inputRankParam_classId">classId</label>
                                <input type="text" class="form-control form-control-sm" id="inputRankParam_classId">
                            </div>
                            <div class="col-6">
                                <label class="small text-muted" for="inputRankParam_schoolyearId">schoolyearId</label>
                                <input type="text" class="form-control form-control-sm" id="inputRankParam_schoolyearId">
                            </div>
                            <div class="col-6">
                                <label class="small text-muted" for="inputRankParam_schoolsemesterId">schoolsemesterId</label>
                                <input type="text" class="form-control form-control-sm" id="inputRankParam_schoolsemesterId">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-primary px-4" id="rankSubmit">查询</button>
                    </div>
                    <div class="hide" id="rankResult">
                        <hr>
                        <table class="table table-hover table-sm text-nowrap" id="rankTable"></table>
                    </div>
                </div>
                <!--开发中
                <div class="tab-pane fade" id="uploadTabPanel" role="tabpanel"></div>
                <div class="tab-pane fade" id="planTabPanel" role="tabpanel"></div>-->
            </div>
        </div>
    </div>

    @component("autozp::components.modal")
        @slot("id", "loginModal")
        @slot("title", "登录综评系统")
        <p>请输入<strong>综评系统</strong>的用户名和密码来登录。</p>
        <div id="loginForm">
            <div class="form-group">
                <label for="loginInputUsername">教育ID</label>
                <input type="text" class="form-control" id="loginInputUsername" minlength="8" maxlength="8" placeholder="请输入教育ID" value="{{ Cookie::get("autozp_username") }}" required="required">
            </div>
            <div class="form-group">
                <label for="loginInputPassword">密码</label>
                <input type="password" class="form-control" id="loginInputPassword" placeholder="请输入密码" value="{{ Cookie::get("autozp_password") }}" required="required">
            </div>
            <div class="form-group hide" id="loginValidateCodeGroup">
                <label for="loginInputValidateCode">验证码</label>
                <input type="hidden" id="loginInputValidateFlag">
                <div class="input-group">
                    <input type="text" class="form-control" id="loginInputValidateCode" placeholder="请输入验证码">
                    <div class="input-group-append">
                        <img class="border" id="loginValidateCodeImage" alt="验证码" title="验证码图片">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="loginRememberPassword">
                    <label class="custom-control-label" for="loginRememberPassword">允许 AutoZP 存储密码</label>
                </div>
                <p class="small form-text text-muted"><strong>一些高级功能需要存储密码才可用</strong>，详见用户协议。</p>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="loginAgreeTerms">
                    <label class="custom-control-label" for="loginAgreeTerms">已阅读并同意<a href="{{ route("autozp.terms") }}" target="_blank">用户协议</a>。</label>
                </div>
            </div>
            <p class="small text-muted mb-0" id="loginTimeHint">登录操作需要大约 10 秒的时间，请耐心等待。</p>
            <p class="text-danger mb-0 mt-2 hide" id="loginError">登录失败：<span></span></p>
            <p class="text-success mb-0 mt-2 hide" id="loginSuccess">登录成功，正在自动<a href="javascript:location.reload();">跳转</a>...</p>
        </div>
        @slot("footer")
            <button class="btn btn-primary hide" id="loginSubmit" disabled="disabled">登录</button>
        @endslot
    @endcomponent

    @component("autozp::components.modal")
        @slot("id", "photoConfirmModal")
        @slot("title", "隐私确认")
        <p class="mb-0">您是否同意AutoZP通过您的信息<abbr title="只是可能获取到">尝试查找</abbr>您的照片？</p>
        <input type="hidden" id="inputPhotoConfirm" value="no">
        @slot("footer")
            <button class="btn btn-success" id="photoConfirm">同意</button>
        @endslot
    @endcomponent
@endsection

@section("bodyjs")
    <script src="{{ asset(mix("js/home.js", "vendor/jingbh/autozp")) }}"></script>
@endsection
