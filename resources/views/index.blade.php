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
            <div class="navbar-item">
                <input type="text">
            </div>
        </div>
        <div class="fr">
            <a ui-sref="home" class="navbar-item">home</a>
            <a ui-sref="login" class="navbar-item">login</a>
            <a ui-sref="signup" class="navbar-item">signup</a>
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
    <div class="login container">
        登录
        aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    </div>
</script>
<script type="text/ng-template" id="signup.tpl">
    <div class="signup container">
        注册
        aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    </div>
</script>
</html>