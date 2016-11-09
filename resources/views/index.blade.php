<!DOCTYPE html>
<html ng-app="blacksun" user-id="{{session('user_id')}}">
<head lang="zh" >
    <meta charset="UTF-8">
    <title>blacksun</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/public/node_modules/normalize-css/normalize.css" rel="stylesheet">
    <link href="/public/css/base.css" rel="stylesheet">
    <script src="/public/node_modules/jquery/dist/jquery.js" type="text/javascript"></script>
    <script src="/public/node_modules/angular/angular.js" type="text/javascript"></script>
    <script src="/public/node_modules/angular-ui-router/release/angular-ui-router.js"  type="text/javascript"></script>
    <script src="/public/js/base.js" type="text/javascript"></script>
    <script src="/public/js/common.js" type="text/javascript"></script>
    <script src="/public/js/user.js" type="text/javascript"></script>
    <script src="/public/js/question.js" type="text/javascript"></script>
    <script src="/public/js/answer.js" type="text/javascript"></script>
</head>
<body>
<div class="navbar clearfix">
    <div class="container">
        <div class="fl">
            <div ui-sref="home" class="navbar-item brand">blacksun</div>
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
</html>