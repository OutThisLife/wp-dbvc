<?php
/**
 * wp-dbvc
 *
 * Tools/admin screen
 */

global $wpdb;
?>

<div class='wpdbvc-header'>
  <h1><?= __('DB Version Control', 'wp-dbvc') ?></h1>
</div>

<div class='wrap wpdbvc-body'>
  <div class='page-title flex'>
    <h1 class='wp-leading-inline'>Databases</h1>
    <a href='javascript:;' class='page-title-action'>Add Environment</a>
  </div>

  <form method='post' action='javascript:;'>
    <input type='text' name='alias' placeholder="Alias ('staging')" />
    <input type='text' name='host' placeholder='Connection string' />
  </form>

  <hr />

  <table class='widefat striped'>
    <thead>
      <th>Name</th>
      <th>Last change</th>
      <th></th>
    </thead>

    <tbody>
      <tr>
        <td>
          <strong>Development</strong>
          <p><?= env('DB_HOST') ?: env('DATABASE_URL') ?: 'localhost' ?>/<?= env('DB_NAME') ?>
          </p>
        </td>

        <td>N/A</td>

        <td class='row-actions'>
          <span><a href='javascript:;'>refresh</a></span>
          <span class='delete'><a href='javascript:;'>delete</a></span>
        </td>
      </tr>
    </tbody>
  </table>
</div>
