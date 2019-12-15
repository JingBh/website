<!doctype html>
<html lang="zh_CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#343a40">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/fontawesome/css/all.min.css">
    <style>
        body {
            margin-top: 60px;
        }
        .data-user {
            background-color: var(--dark);
            color: white;
            border-color: rgba(255, 255, 255, 0.125);
            padding: 0.5rem;
            white-space: nowrap;
        }
    </style>
    <script>
        const _cache = {};
        const _charts = {
            "chart": null
        };
        const _localizedDataUrl = '{{ LaravelLocalization::localizeUrl('/ncm_rank/data') }}';
    </script>
    <title>NCMRank by JingBh</title>
</head>
<body class="bg-dark text-light">
<nav class="navbar fixed-top navbar-expand navbar-dark bg-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/" title="返回JingBh主页"><i class="fas fa-home"></i></a>
        </li>
    </ul>
    <span class="w-100 navbar-brand text-center">NCMRank by JingBh</span>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#" title="关于NCMRank" id="aboutButton"><i class="fas fa-info-circle"></i></a>
        </li>
    </ul>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-xl-2">
            <h5 class="font-weight-light text-center mb-2">选择用户 <a class="d-md-none text-decoration-none text-reset" role="button" data-toggle="collapse" href="#userList" id="userListToggle"><i class="fas fa-caret-down"></i></a></h5>
            <div class="collapse" id="userList">
                <div class="list-group">
                    @foreach ($users as $user)
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center data-user" data-uid="{{$user->id}}">
                            <span class="text-truncate">{{$user->name}}</span>
                            <span class="badge badge-danger badge-pill">Lv.{{$user->level}}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-9 col-xl-10">
            <h4 class="font-weight-light text-center mt-2 mb-n4 my-md-0" id="loading"><span class="spinner-border text-primary" role="status"></span> 加载数据中...</h4>
            <div class="card text-white bg-dark border-info mb-3" id="data" style="display:none;">
                <div class="card-header">
                    <h3 class="font-weight-light card-title d-flex align-items-center mb-1" style="white-space:nowrap;">
                        <img class="rounded-circle mr-2" id="avatar" style="height:1.75rem;width:1.75rem;" alt="头像">
                        <span class="text-truncate pb-1" id="username"></span>
                        <span class="badge badge-danger badge-pill font-weight-normal ml-2">Lv.<span id="level"></span></span>
                    </h3>
                    <h6 class="font-weight-normal mb-0">累计听歌<strong id="total"></strong>首<span class="hide-l10">，再听<strong id="remain"></strong>首即可升级</span></h6>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-normal">平均值统计</h5>
                    <ul>
                        <li>自注册以来的<strong id="regDays"></strong>天里，平均每天听歌<strong id="averageReg"></strong>首<span class="hide-l10">；按照这个速度，升级还需<strong id="remainDaysReg"></strong>天</span></li>
                        <li>自<abbr title="2019年7月17日">开始收集数据</abbr>以来，平均每天听歌<strong id="averageAll"></strong>首<span class="hide-l10">；按照这个速度，升级还需<strong id="remainDaysAll"></strong>天</span></li>
                        <li>最近一周，平均每天听歌<strong id="averageWeek"></strong>首<span class="hide-l10">；按照这个速度，升级还需<strong id="remainDays"></strong>天</span></li>
                        <li>最近一个月，平均每天听歌<strong id="averageMonth"></strong>首<span class="hide-l10">；按照这个速度，升级还需<strong id="remainDaysMonth"></strong>天</span></li>
                        <li>自开始收集数据以来，平均每周听歌<strong id="averageByWeek"></strong>首</li>
                    </ul>
                    <div class="row">
                        <div class="col-sm">
                            <h5 class="font-weight-normal">听歌量统计图</h5>
                        </div>
                        <div class="col-sm-auto text-right d-flex justify-content-between align-items-center">
                            <div class="btn-group" role="group">
                                <button class="btn btn-secondary btn-sm" id="chartByDay" data-action="day">按天</button>
                                <button class="btn btn-secondary btn-sm" id="chartByWeek" data-action="week">按星期</button>
                            </div>
                            <div class="btn-group ml-2" role="group" id="chartZoom">
                                <button class="btn btn-secondary btn-sm" id="chartZoomIn" data-action="in"><i class="fas fa-search-plus"></i></button>
                                <button class="btn btn-secondary btn-sm" id="chartZoomOut" data-action="out"><i class="fas fa-search-minus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 mb-n2" id="chartContainer" style="width:100%;height:50vh;position:relative;"></div>
                </div>
                <div class="card-footer">
                    <p class="text-right text-secondary mb-0">数据更新时间：<span id="lastUpdate"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/jquery/dist/jquery.min.js"></script>
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/chart.js/dist/Chart.min.js"></script>
<script src="{{ mix("/js/ncmrank/app.js") }}"></script>
</body>
</html>
