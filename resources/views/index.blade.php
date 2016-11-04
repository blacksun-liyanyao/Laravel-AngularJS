<!DOCTYPE html>
<html ng-app="blacksun">
<head lang="zh" >
    <meta charset="UTF-8">
    <title>blacksun</title>
    <link href="/public/node_modules/normalize-css/normalize.css" rel="stylesheet">
    <link href="/public/css/base.css" rel="stylesheet">
    <script src="/public/node_modules/jquery/dist/jquery.js" type="text/javascript"></script>
    <script src="/public/node_modules/angular/angular.js" type="text/javascript"></script>
    <script src="/public/node_modules/angular-ui-router/release/angular-ui-router.js"  type="text/javascript"></script>
    <script src="/public/js/base.js" type="text/javascript"></script>
</head>
<body>
<div class="navbar clearfix">
    <div class="container">
        <div class="fl">
            <div class="navbar-item brand">blacksun</div>
            <form ng-submit="Question.go_add_question()" id="quick_ask" ng-controller="QuestionAddController">
                <div class="navbar-item">
                    <input ng-model="Question.new_question.title" type="text">
                </div>
                <div class="navbar-item">
                    <button type="submit" class="primary">提交</button>
                </div>
            </form>
        </div>
        <div class="fr">
            <a ui-sref="home" class="navbar-item">首页</a>
            @if(is_logged_in())
                <a ui-sref="login" class="navbar-item">{{session('username')}}</a>
                <a href="{{url('/api/logout')}}" class="navbar-item">登出</a>
            @else
                <a ui-sref="login" class="navbar-item">登录</a>
                <a ui-sref="signup" class="navbar-item">注册</a>
            @endif
        </div>
    </div>
</div>
<div class="page">
    <div ui-view></div>
</div>

</body>
<script type="text/ng-template" id="home.tpl">
    <div class="home card container">
        <h1>最新动态</h1>
        <div class="hr"></div>
        <div class="item-set">
            <div class="item">
                <div class="vote"></div>
                <div class="feed-item-content">
                    <div class="content-act">王小虎赞同了该回答</div>
                    <div class="title">为何蒙特利尔有如此多的游戏工作室？</div>
                    <div class="content-owner">触乐
                        <span class="desc">高品质、有价值、有趣的移动游戏资讯</span>
                    </div>
                    <div class="content-main">
                        sdafasdfasdfasdfsdaaasdfsdfsdfsdfxcfgvzscfzsd
                        sdafasdfasdfasdfsdaaasdfsdfsdfsdfxcfgvzscfzsd
                        sdafasdfasdfasdfsdaaasdfsdfsdfsdfxcfgvzscfzsd
                        sdafasdfasdfasdfsdaaasdfsdfsdfsdfxcfgvzscfzsd
                    </div>
                    <div class="action-set">
                        <div class="comment">评论</div>
                    </div>
                    <div class="comment-block">
                        <div class="comment-item-set">
                            <div class="rect"></div>
                            <div class="comment-item clearfix">
                                <div class="user">test</div>
                                <div class="comment-content">
                                    sdafasdfasdfasdfsdaaasdfsdfsdfsdfxcfgvzscfzsd
                                    sdafasdfasdfasdfsdaaasdfsdfsdfsdfxcfgvzscfzsd
                                    sdafasdfasdfasdfsdaaasdfsdfsdfsdfxcfgvzscfzsd
                                </div>
                            </div>
                            <div class="comment-item clearfix">
                                <div class="user">test</div>
                                <div class="comment-content">
                                    sdafasdfasdfasdfsdaaasdfsdfsdfsdfxcfgvzscfzsd
                                    sdafasdfasdfasdfsdaaasdfsdfsdfsdfxcfgvzscfzsd
                                    sdafasdfasdfasdfsdaaasdfsdfsdfsdfxcfgvzscfzsd
                                </div>
                            </div>
                            <div class="comment-item clearfix">
                                <div class="user">test</div>
                                <div class="comment-content">
                                    sdafasdfasdfasdfsdaaasdfsdfsdfsdfxcfgvzscfzsd
                                    sdafasdfasdfasdfsdaaasdfsdfsdfsdfxcfgvzscfzsd
                                    sdafasdfasdfasdfsdaaasdfsdfsdfsdfxcfgvzscfzsd
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hr"></div>
            </div>
        </div>
    </div>
</script>
<script type="text/ng-template" id="login.tpl">
    <div ng-controller="LoginController" class="login container">
        <div class="card">
            <h1>登录</h1>
            <form name="login_form" ng-submit="User.login()">
                <div class="input-group">
                    <label>用户名:</label>
                    <input name="username" type="text" ng-model="User.login_data.username"
                            required>
                </div>
                <div class="input-group">
                    <label>密码:</label>
                    <input name="password" type="password" ng-model="User.login_data.password"
                           required>
                </div>
                <div ng-if="User.login_failed" class="input-error-set">
                    用户名或密码有误
                </div>
                <div class="input-group">
                    <button class="primary" type="submit"
                            ng-disabled="login_form.username.$error.required ||
                            login_form.password.$error.required">登录</button>
                </div>
            </form>
        </div>
    </div>
</script>
<script type="text/ng-template" id="signup.tpl">
    <div ng-controller="SignupController" class="signup container">
        <div class="card">
            <h1>注册</h1>
            {{--[: User.signup_data :]--}}
            <form name="signup_form" ng-submit="User.signup()">
                <div class="input-group">
                    <label>用户名:</label>
                    <input name="username" type="text" ng-minlength="4"
                           ng-maxlength="24" ng-model="User.signup_data.username"
                            ng-model-options="{debounce:500}" required>
                    <div ng-if="signup_form.username.$touched" class="input-error-set">
                        <div ng-if="signup_form.username.$error.required">用户名为必填项</div>
                        <div ng-if="signup_form.username.$error.minlength ||
                        signup_form.username.$error.maxlength">用户名长度必须在4-24位之间</div>
                        <div ng-if="User.signup_username_exists">用户名已存在</div>
                    </div>
                </div>
                <div class="input-group">
                    <label>密码:</label>
                    <input name="password" type="password" ng-minlength="6"
                           ng-maxlength="255" ng-model="User.signup_data.password"
                           required>
                    <div ng-if="signup_form.password.$touched" class="input-error-set">
                        <div ng-if="signup_form.password.$error.required">密码为必填项</div>
                        <div ng-if="signup_form.password.$error.minlength ||
                        signup_form.password.$error.maxlength">密码长度必须在6-255位之间</div>
                    </div>
                </div>
                <button class="primary" ng-disabled="signup_form.$invalid" type="submit">注册</button>
            </form>
        </div>
    </div>
</script>
<script type="text/ng-template" id="question.add.tpl">
    <div ng-controller="QuestionAddController" class="question-add container">
        <div class="card">
            <form name="question_add_form" ng-submit="Question.add()">
                <div class="input-group">
                    <label>问题标题</label>
                    <input type="text"
                           name="title"
                           ng-minlength="5"
                           ng-maxlength="255"
                           ng-model="Question.new_question.title"
                            required>
                </div>
                <div class="input-group">
                    <label>问题描述</label>
                    <textarea type="text"
                              name="desc"
                              ng-model="Question.new_question.desc"></textarea>
                </div>
                <div class="input-group">
                    <button ng-disabled="question_add_form.$invalid"
                            class="primary" type="submit">提交</button>
                </div>
            </form>
        </div>
    </div>
</script>
</html>