<?php if(isset($_SESSION['toast'])): ?>
<div class="toast-container position-fixed bottom-0 p-3" style="z-index: 9999; right: 36%; translateX(50px)">
  <div class="toast align-items-center text-bg-<?= htmlspecialchars($_SESSION['toast']['type']) ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        <?= htmlspecialchars($_SESSION['toast']['message']) ?>
      </div>

      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close">
      </button>
    </div>
  </div>
</div>

<?php unset($_SESSION['toast']); endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    let toastEl = document.querySelector('.toast');

    if(toastEl) {
      let toast = new bootstrap.Toast(toastEl, {delay: 4000 });
      toast.show();
    }
  });
</script>
  </body>
</html>