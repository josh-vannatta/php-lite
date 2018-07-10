<div class="form-group --responsive">
  <div class="--inline">
    <div class="dropdown">
      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <?php if (App::uri('system/create')): ?>Custom<?php else: ?>Current<?php endif; ?>
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <?php if (!App::uri('system/create')): ?>
        <li><a id="password-toggle" href="javascript:;" class="dropdown-el" onclick="toggleDropdown(this)">Current</a></li>
        <?php endif; ?>
        <li><a href="javascript:;" class="dropdown-el" onclick="toggleDropdown(this)">Random</a></li>
        <li><a href="javascript:;" class="dropdown-el --active" onclick="toggleDropdown(this)">Custom</a></li>
      </ul>
    </div>
    <div style="width: 100%">
      <label for="published">New Password</label>
      <input type="password" class="form-control --password-control <?php if (!App::uri('system/create')): ?>--disabled<?php endif; ?>"
        name="password"
        placeholder="New password"
        fs--input="Password"
        fs--rules="required|strength:{min:6, bonus:8}|pass_default"
        <?php if (!App::uri('system/create')): ?>
        disabled="disabled"
        value="Userdefinedpassword18!"
        <?php endif; ?>
        >
    </div>
  </div>
</div>
<h4 class="--subsection-header">Permissions</h4>
<div class="--options-group">
  <div class="--toggle-group">
    <div class="--helper-block">
      <p>Manage News</p>
      <div class="--helper">
        <span>?</span>
        <div class="--helper-msg">
          If enabled, admins will be able to create, edit and delete news items.
        </div>
      </div>
    </div>
    <label class="switch">
      <input type="checkbox" name="news_ctrl"
        <?php if ($admin->permissions != null && in_array('news_ctrl',$admin->permissions)): ?>
          checked="checked"
        <?php endif; ?>>
      <span class="slider round"></span>
    </label>
  </div>
  <div class="--toggle-group">
    <div class="--helper-block">
      <p>Manage Accounts</p>
      <div class="--helper">
        <span>?</span>
        <div class="--helper-msg">
          If enabled, admins will be able to create, edit and delete other admin accounts.
        </div>
      </div>
    </div>
    <label class="switch">
      <input type="checkbox" name="acct_ctrl"
        <?php if ($admin->permissions != null && in_array('acct_ctrl',$admin->permissions)): ?>
          checked="checked"
        <?php endif; ?>>
      <span class="slider round"></span>
    </label>
  </div>
  <div class="--toggle-group">
    <div class="--helper-block">
      <p>View Accounts</p>
      <div class="--helper">
        <span>?</span>
        <div class="--helper-msg">
          If enabled, admins will be able to view other admin account details, including permissions.
        </div>
      </div>
    </div>
    <label class="switch">
      <input type="checkbox" name="acct_view"
        <?php if ($admin->permissions != null && in_array('acct_view',$admin->permissions)): ?>
          checked="checked"
        <?php endif; ?>>
      <span class="slider round"></span>
    </label>
  </div>
</div>
