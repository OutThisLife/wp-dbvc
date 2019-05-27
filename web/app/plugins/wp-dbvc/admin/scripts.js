(function () {
  const $app = document.getElementById('wp-dbvc')

  if ($app instanceof HTMLElement) {
    const $form = $app.querySelector('.wpdbvc-addnew')

    ;[].slice.call($app.querySelectorAll('.wpdbvc-toggle')).forEach($a =>
      $a.addEventListener('click', () =>
        $form.classList.toggle('open') && $form.querySelector('input').focus()
      )
    )
  }
})()
