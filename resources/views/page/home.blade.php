<div ng-controller="HomeController" class="home card container">
    <h1>最新动态</h1>
    <div class="hr"></div>
    <div class="item-set">
        <div ng-repeat="item in Timeline.data" class="feed item clearfix">
            <div ng-if="item.question_id" class="vote">
                <div ng-click="Timeline.vote({id:item.id,vote:1})" class="up">赞[: item.upvote_count :]</div>
                <div ng-click="Timeline.vote({id:item.id,vote:2})" class="down">踩[: item.downvote_count :]</div>
            </div>
            <div class="feed-item-content">
                <div ng-if="item.question_id" class="content-act">[: item.user.username :]添加了回答</div>
                <div ng-if="!item.question_id" class="content-act">[: item.user.username :]添加了提问</div>
                <div class="title">[: item.title :]</div>
                <div class="content-owner">[: item.user.username :]
                    <span class="desc">高品质、有价值、有趣的移动游戏资讯</span>
                </div>
                <div class="content-main">
                    [: item.desc :]
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
        <div ng-if="Timeline.pending" class="tac">加载中</div>
        <div ng-if="Timeline.no_more_data" class="tac">没有更多数据了</div>
    </div>
</div>