<!doctype html>
<html ng-controller="BaseController" lang="zh" ng-app="xiaohu" user-id="<?php echo e(session('user_id')); ?>">
<head>
    <meta charset="UTF-8">
    <title>晓乎</title>
    <link rel="stylesheet" href="/public/node_modules/normalize-css/normalize.css">
    <link rel="stylesheet" href="/css/base.css">
    <script src="/public/node_modules/jquery/dist/jquery.js"></script>
    <script src="/public/node_modules/angular/angular.js"></script>
    <script src="/public/node_modules/angular-ui-router/release/angular-ui-router.js"></script>
    <script src="/js/base.js"></script>
    <script src="/js/common.js"></script>
    <script src="/js/user.js"></script>
    <script src="/js/question.js"></script>
    <script src="/js/answer.js"></script>
</head>
<body>
<div class="navbar clearfix">
    <div class="container">
        <div class="fl">
            <div ui-sref="home" class="navbar-item brand">晓乎</div>
            <form ng-submit="Question.go_add_question()"
                  id="quick_ask"
                  ng-controller="QuestionController">
                <div class="navbar-item">
                    <input ng-model="Question.new_question.title" type="text">
                </div>
                <div class="navbar-item">
                    <button type="submit">提问</button>
                </div>
            </form>
        </div>
        <div class="fr">
            <a ui-sref="home" class="navbar-item">首页</a>
            <?php if(is_logged_in()): ?>
                <a ui-sref="login" class="navbar-item"><?php echo e(session('username')); ?></a>
                <a href="<?php echo e(url('/api/logout')); ?>" class="navbar-item">登出</a>
            <?php else: ?>
                <a ui-sref="login" class="navbar-item">登录</a>
                <a ui-sref="signup" class="navbar-item">注册</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="page">
    <div ui-view></div>
</div>
<script type="text/ng-template" id="comment.tpl">
    <div class="comment-block">
        <div class="hr"></div>
        <div class="comment-item-set">
            <div class="rect"></div>
            <div class="gray tac well" ng-if="!helper.obj_length(data)">暂无评论</div>
            <div ng-if="helper.obj_length(data)"
                 ng-repeat="item in data" class="comment-item clearfix">
                <div class="user">[: item.user.username :]:</div>
                <div class="comment-content">[: item.content :]</div>
            </div>
            <?php /*<div class="comment-item clearfix">*/ ?>
            <?php /*<div class="user">sdf</div>*/ ?>
            <?php /*<div class="comment-content">*/ ?>
            <?php /*Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore dol*/ ?>
            <?php /*</div>*/ ?>
            <?php /*</div>*/ ?>
            <?php /*<div class="comment-item clearfix">*/ ?>
            <?php /*<div class="user">Lee</div>*/ ?>
            <?php /*<div class="comment-content">*/ ?>
            <?php /*Lorem*/ ?>
            <?php /*</div>*/ ?>
            <?php /*</div>*/ ?>
        </div>
        <div class="input-group">
            <form ng-submit="_.add_comment()" class="comment_form">
                <input type="text"
                       ng-model="Answer.new_comment.content"
                       placeholder="说些什么...">
                <button class="primary" type="submit">评论</button>
            </form>
        </div>
    </div>
</script>
</body>
</html>