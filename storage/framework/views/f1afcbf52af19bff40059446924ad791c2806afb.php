<div ng-controller="LoginController" class="login container">
    <div class="card">
        <h1>登录</h1>
        <form name="login_form" ng-submit="User.login()">
            <div class="input-group">
                <label>用户名</label>
                <input name="username"
                       type="text"
                       ng-model="User.login_data.username"
                       required
                >
            </div>
            <div class="input-group">
                <label>密码</label>
                <input name="password"
                       type="password"
                       ng-model="User.login_data.password"
                       required
                >
            </div>
            <div ng-if="User.login_failed" class="input-error-set">
                用户名或密码有误
            </div>
            <div class="input-group">
                <button type="submit"
                        class="primary"
                        ng-disabled="login_form.username.$error.required ||
                            login_form.password.$error.required"
                >登录
                </button>
            </div>
        </form>
    </div>
</div>