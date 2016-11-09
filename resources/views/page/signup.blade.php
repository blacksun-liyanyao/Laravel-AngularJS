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