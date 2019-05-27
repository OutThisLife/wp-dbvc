<?php
/**
 * wp-dbvc
 *
 * Tools/admin screen
 */

global $wpdb;
$keys = ['Production', 'Development'];
?>

<div id='wp-dbvc'>
  <div class='wpdbvc-header'>
    <h1><?=__('DB Version Control', 'wp-dbvc')?></h1>
  </div>

  <div class='wrap wpdbvc-body'>
    <div class='page-title flex'>
      <h1 class='wp-leading-inline'>Databases</h1>

      <a href='javascript:;' class='wpdbvc-toggle page-title-action'>
        Add Environment
      </a>
    </div>

    <form class='wpdbvc-addnew' method='post' action='javascript:;'>
      <div class='form-fields'>
        <input type='text' name='alias' placeholder="Alias ('staging')" />
        <input type='text' name='host' placeholder='Connection string' />
      </div>

      <div class='form-footer'>
        <button type='submit' class='button button-primary'>Save</button>
        <button type='reset' class='button wpdbvc-toggle'>Cancel</button>
      </div>
    </form>

    <table class='widefat striped wpdbvc-envs'>
      <thead>
        <th width="55%">Name</th>
        <th>Touched</th>
        <th></th>
      </thead>

      <tbody>
        <?php foreach ($keys as $k): ?>
        <tr>
          <td>
            <h3><?=$k?></h3>
            <p>mysql://<?=env('DB_HOST') ?: env('DATABASE_URL') ?: 'localhost'?>/<?=env('DB_NAME')?>
            </p>
          </td>

          <td><?=mt_rand(1, 6)?> minute(s) ago</td>

          <td>
            <select>
              <option selected>Merge into</option>
              <?php foreach (array_diff($keys, [$k]) as $o): ?>
              <option><?=$o?></option>
              <?php endforeach?>
            </select>

            <br />

            <a href='javascript:;' class='delete'>Remove</a>
          </td>
        </tr>
        <?php endforeach?>
      </tbody>
    </table>
  </div>
</div>
