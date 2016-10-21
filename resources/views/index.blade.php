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
            <a ui-sref="login" class="navbar-item">登录</a>
            <a ui-sref="signup" class="navbar-item">注册</a>
        </div>
    </div>
</div>
<div class="page">
    <div ui-view></div>
</div>

</body>
<script type="text/ng-template" id="home.tpl">
    <div class="home container">
        首页
        aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
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
</html>