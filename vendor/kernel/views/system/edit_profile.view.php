    <button type="submit" style="margin: 30px 0 15px" class="--button-gen --transition" fs--button>Submit</button>
  </div>
</form>
<form id="edit-password-form" class="news-item" method="post"
  style="letter-spacing: 0" action="/admin/system/update_password"
  fs--form fs--listen="<?php if (session('input_data')) echo 'now' ?>">
  <input type="hidden" name="current" value="<?= $admin->email ?>">
  <div >
    <h4 class="--subsection-header --simple">Change Password</h4>
    <div class="form-group --responsive">
      <label for="published">Current Password</label>
      <input id="current-password" type="password" class="form-control"
        name="current-password"
        placeholder="Current Password"
        fs--input="The new password"
        fs--rules="required">
    </div>
    <div class="form-group --responsive">
      <label for="published">New Password</label>
      <input id="new-password" type="password" class="form-control"
        name="password"
        placeholder="New Password"
        fs--input="The new password"
        fs--rules="required|strength:{min:8, bonus:8}">
    </div>
    <div class="form-group --responsive">
      <label for="published">Confirm Password</label>
      <input type="password" class="form-control"
        name="confirm-password"
        placeholder="Confirm Password"
        fs--input="The confirmed password"
        fs--rules="pass_match:{twin:#new-password}">
    </div>
