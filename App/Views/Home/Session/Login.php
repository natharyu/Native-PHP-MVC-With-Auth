<section id="loginForm">
  <?php if( isset( $_GET['error'] ) ) : ?>
      <p class="alert alert-danger text-center" role="alert"><i class="bi bi-exclamation-circle p-2"></i><?= htmlspecialchars($_GET['error']) ?></p>
  <?php endif; ?>
  <?php if( isset( $_GET['success'] ) ) : ?>
      <p class="alert alert-success text-center" role="alert"><i class="bi bi-check-circle p-2"></i><?= htmlspecialchars($_GET['success']) ?></p>
  <?php endif; ?>

  <article class="col-8 card mx-auto p-4 my-5 shadow bg-body rounded">
    <h2 class="text-center pb-4">Login</h2>
    
    <form class="row g-3" method="POST" action="/login/validate" novalidate>
      <div class="col-md-12">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control <?php if(isset($error['username'])) : ?> border border-danger <?php endif; ?>" id="username" name="username" placeholder="Your username" aria-describedby="inputGroupPrepend" <?php if(isset($currentValues['username'])) : ?> value="<?= htmlspecialchars($currentValues['username']) ?>" <?php endif ; ?> required>
        <?php if(isset($error['username'])) : ?>
          <p class="text-danger"><i class="bi bi-exclamation-circle p-1"></i><?= htmlspecialchars($error['username']) ?></p>
        <?php endif; ?>
      </div>

      <div class="col-md-12">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control <?php if(isset($error['password'])) : ?> border border-danger <?php endif; ?>" id="password" name="password" placeholder="Your password" required>
        <?php if(isset($error['password'])) : ?>
          <p class="text-danger"><i class="bi bi-exclamation-circle p-1"></i><?= htmlspecialchars($error['password']) ?></p>
        <?php endif; ?>
      </div>
      
      <button class="btn btn-primary col-3 mx-auto mt-4" type="submit">Login</button>
    </form>
  </article>
</section>