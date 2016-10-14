<!DOCTYPE html>
<html>
<head lang="zh" ng-app="blacksun">
    <meta charset="UTF-8">
    <title>blacksun</title>
    <link href="/node_modules/normalize-css/normalize.css" rel="stylesheet">
    <link href="/css/base.css" rel="stylesheet">
    <script src="/node_modules/jquery/dist/jquery.js" type="text/javascript"></script>
    <script src="/node_modules/angular/angular.js" type="text/javascript"></script>
    <script src="/node_modules/angular-ui-router/release/angular-ui-router.js"  type="text/javascript"></script>
    <script src=" /js/base.js" type="text/javascript"></script>
</head>
<body>
<div class="navbar">
    <a href="" ui-sref="login">login</a>
</div>
<div>
    <div ui-view></div>
</div>
</body>
<script type="text/ng-template" id="login.tpl">
<div>
    <h1>首页</h1>
</div>
</script>
</html>