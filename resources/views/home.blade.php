<!doctype html>
<html class="sr" lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Description" content="一名热衷网络的高中学生的个人主页，里面有个人介绍和许多作品。">
    <meta name="theme-color" content="#50a6bd">
    <link rel="stylesheet" href="{{ mix("/css/bootstrap-edited.css") }}">
    <link rel="stylesheet" href="/static/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/static/css/homepage.css">
    <title>JingBh个人主页</title>
</head>
<body>
<div id="bg"></div>
<!--<div class="container">
    <nav class="navbar navbar-expand-sm navbar-dark" id="navbar">
        <a class="navbar-brand" href="/"><img src="/static/image/official/logo.png" alt="My logo" title="JingBh个人主页"></a>
    </nav>
</div> Navbar -->
<div class="container load-hidden" id="avatarContainer">
    <img class="rounded-circle" src="/static/img/head.png" id="avatar" alt="My avatar">
    <h1 class="mt-3 font-weight-light">JingBh</h1>
    <i class="fal fa-mars" style="color:lightskyblue;" title="Male"></i>
    <span class="text-muted mx-1">/</span>
    <span>15 Years Old</span><br>
    <small><i class="fal fa-map-marker-alt text-orange" title="Position"></i> 北京市 海淀区</small>
</div>
<div class="container load-hidden" id="introContainer">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-6">
            <p>我叫JingBh，是一名高一学生。我从小就对电子设备非常感兴趣，现在热衷于研究网络，业余时间喜欢写程序、写网页。您现在看到的这个网站以及下面列出的所有项目都由我自己编写。</p>
        </div>
    </div>
    <div class="row form-row justify-content-center text-center load-hidden" id="introButtons">
        <!--<div class="col-12 col-sm-auto mt-3">
            <div class="btn-group">
                <a class="btn btn-teal" href="/message" target="_blank" title="留言" data-toggle="tooltip"><i class="fal fa-comment-dots"></i> Leave a Message</a>
                <button class="btn btn-teal dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"><span class="sr-only">Toggle Dropdown</span></button>
                <div class="dropdown-menu" style="z-index:100000;">
                    <a class="dropdown-item" href="mailto:jingbohao@yeah.net" target="_blank"><i class="fal fa-envelope"></i> 电子邮件</a>
                </div>
            </div>
        </div>-->
        <div class="col-12 col-sm-auto mt-3">
            <button class="btn btn-indigo" data-toggle="modal" data-target="#sponsorModal"><i class="fal fa-donate"></i> Sponsor Me</button>
        </div>
    </div>
</div>
<div class="container load-hidden my-5" id="infoCard">
    <div class="container-card">
        <div class="load-hidden mt-2" id="infoArrow">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <i class="far fa-chevron-down fa-3x up-and-down"></i>
                </div>
                <div class="col-auto text-center">
                    <h2 class="font-weight-light">教育与能力</h2>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <div class="row">
                <div class="col-md-6 col-lg-7">
                    <div class="load-hidden" id="infoTitleEdu">
                        <h3 class="font-weight-light">教育</h3>
                        <hr>
                    </div>
                    <div class="load-hidden data-edu">
                        <div class="row">
                            <div class="col">
                                <h4 class="font-weight-light">小学</h4>
                            </div>
                            <div class="col-auto">
                                <small><i class="fas fa-calendar-alt"></i> 2010年9月~2016年6月</small>
                            </div>
                        </div>
                        <p>2010年9月至2016年6月期间，我就读于北京市朝阳区<a href="http://www.tfbx.net/" target="_blank" rel="noreferrer">白家庄小学</a>望京新城校区。毕业后，搬家到海淀区，跨区升入中学。</p>
                    </div>
                    <div class="load-hidden data-edu">
                        <div class="row">
                            <div class="col">
                                <h4 class="font-weight-light">初中</h4>
                            </div>
                            <div class="col-auto">
                                <small><i class="fas fa-calendar-alt"></i> 2016年7月~2019年6月</small>
                            </div>
                        </div>
                        <p>2016年，我升入初中，进入了<a href="http://www.qhfzsd.com" target="_blank" rel="noreferrer">清华大学附属中学上地学校</a>就读。在此就读期间，我受学校科技活动的影响，开始爱上了编程。</p>
                    </div>
                    <div class="load-hidden data-edu">
                        <div class="row">
                            <div class="col">
                                <h4 class="font-weight-light">高中</h4>
                            </div>
                            <div class="col-auto">
                                <small><i class="fas fa-calendar-alt"></i> 2019年8月</small>
                            </div>
                        </div>
                        <p>现在，我是<a href="http://www.qhfz.edu.cn" target="_blank" rel="noreferrer">清华大学附属中学</a>G19年级的一名学生，是高研计算机科学实验室的成员。</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="load-hidden mt-3 mt-md-0" id="infoTitleSkill">
                        <h3 class="font-weight-light">编程技能</h3>
                        <hr>
                    </div>
                    <div class="row" id="mySkills">
                        <div class="col-lg-6">
                            <div class="progress load-hidden data-skill-p mb-2">
                                <div class="progress-bar bg-indigo data-skill" role="progressbar" style="min-width:3em;width:90%;">PHP</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="progress load-hidden data-skill-p mb-2">
                                <div class="progress-bar bg-purple data-skill" role="progressbar" style="min-width:8em;width:75%;">JavaScript</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="progress load-hidden data-skill-p mb-2">
                                <div class="progress-bar bg-primary data-skill" role="progressbar" style="min-width:5em;width:70%;">Python</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="progress mb-2 load-hidden data-skill-p">
                                <div class="progress-bar bg-info data-skill" role="progressbar" style="min-width:7em;width:60%;">HTML/CSS</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="progress mb-2 load-hidden data-skill-p">
                                <div class="progress-bar bg-success data-skill" role="progressbar" style="min-width:8em;width:45%;">Linux系统运维</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="progress mb-2 load-hidden data-skill-p">
                                <div class="progress-bar bg-warning data-skill" role="progressbar" style="min-width:2.5em;width:5%;" title="想学但又懒得学">C#</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="progress mb-2 load-hidden data-skill-p">
                                <div class="progress-bar bg-transparent text-danger data-skill" role="progressbar" style="min-width:6em;" title="绝对的小白...这就是从高级语言学起的后果...">C++/Java</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="progress mb-2 load-hidden data-skill-p">
                                <div class="progress-bar bg-transparent text-dark data-skill" role="progressbar" style="min-width:3em;" title="会一点点网络安全；比上面这些更基础的就不用说了吧" data-placement="bottom">其它</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container load-hidden my-5" id="projectsCard">
    <div class="container-card">
        <div class="load-hidden mt-2" id="projectsArrow">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <i class="far fa-chevron-down fa-3x up-and-down"></i>
                </div>
                <div class="col-auto text-center">
                    <h2 class="font-weight-light">我的作品</h2>
                </div>
            </div>
        </div>
        <div class="mt-3 px-md-3 load-hidden" id="projectsList">
            <div class="mywork" style="background:linear-gradient(to left, #7f7fd5, #86a8e7, #91eae4);">
                <div class="mywork-flex">
                    <i class="fal fa-arrow-right fa-fw mywork-pointer"></i>
                    <img class="mywork-logo" src="https://storage.jingbh.top/scoredb/logo1000sq.png/Logo128" alt="ScoreDB Logo">
                    <h3 class="mywork-title">ScoreDB</h3>
                </div>
                <p class="mywork-intro"><span class="badge badge-primary">开源</span> 统计我和同学们的考试成绩</p>
                <div class="mywork-content">
                    <p>查询考试成绩，智能计算总分、排名、进步情况，为我和我的同学们提供方便。<br>
                       初中毕业后，ScoreDB v1不再使用。为了继续方便高中的学习生活，使用全新架构、功能更加丰富的<strong>ScoreDB v2</strong><del>正在开发中</del>。<br>
                        <span class="text-danger">由于获取数据的行为违反相关规定，ScoreDB不再开放和继续开发。</span></p>
                    <a class="btn btn-secondary mt-2" href="https://github.com/JingBh/ScoreDB" target="_blank"><i class="fab fa-github"></i> 代码仓库</a>
                </div>
            </div>
            <div class="mywork" style="background:linear-gradient(to left, #ef3b36, #ffffff);">
                <div class="mywork-flex">
                    <i class="fal fa-arrow-right fa-fw mywork-pointer"></i>
                    <h3 class="mywork-title">NCMRank</h3>
                </div>
                <p class="mywork-intro"><span class="badge badge-secondary">私用</span> 统计网易云音乐听歌量</p>
                <div class="mywork-content">
                    <p class="mb-0">一个用来统计我自己在网易云音乐每天听歌数目和升级进度的小工具，不对其他用户开放。</p>
                    <a class="btn btn-primary mt-2" href="/ncm_rank/" target="_blank">参观一下</a>
                </div>
            </div>
            <p class="mb-0 lead"><strong>还有很多很多......</strong></p>
            <p class="text-pink text-right small">但是基本上都废弃了。</p>
        </div>
    </div>
</div>
<div class="container-fluid p-0 mt-3" id="footer">
    <footer class="text-dark p-5">
        <h5>本站由JingBh设计制作，版权所有 &copy; JingBh 2018-2019，保留所有权利。<br></h5>
        <hr>
        <h5>友情链接</h5>
        <small class="mb-1">
            <a class="text-dark" href="https://www.zhc7.top/" target="_blank" rel="noreferrer">ZHC</a>
        </small>
    </footer>
</div>
<div class="modal fade" id="sponsorModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="far fa-donate"></i> Sponsor Me</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <img class="img-fluid" src="/static/img/donate.png" alt="付款二维码">
            </div>
            <div class="modal-footer">
                <p class="lead text-muted">对您的一切支持表示由衷感谢！</p>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ mix("/js/home/manifest.js") }}"></script>
<script src="{{ mix("/js/home/vendor.js") }}"></script>
<script src="{{ mix("/js/home/app.js") }}"></script>
</body>
</html>
