<section id="registerFrom">
    <article class="col-8 card mx-auto p-4 my-5 shadow bg-body rounded">
      <h2 class="text-center pb-4">Register</h2>
      
      <form class="row g-3" method="POST" action="/register/validate" novalidate>
        <div class="col-md-6">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control <?php if(isset($error['username'])) : ?> border border-danger <?php endif; ?>" id="username" name="username" placeholder="Your username" <?php if(isset($currentValues['username'])) : ?> value="<?= htmlspecialchars($currentValues['username']) ?>" <?php endif ; ?> required>
          <?php if(isset($error['username'])) : ?>
            <p class="text-danger"><i class="bi bi-exclamation-circle p-1"></i><?= htmlspecialchars($error['username']) ?></p>
          <?php endif; ?>
        </div>
        <div class="col-md-6">
          <label for="email" class="form-label">Email</label>
          <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend">@</span>
            <input type="text" class="form-control <?php if(isset($error['email'])) : ?> border border-danger <?php endif; ?>" id="email" name="email" placeholder="Your email" aria-describedby="inputGroupPrepend" <?php if(isset($currentValues['email'])) : ?> value="<?= htmlspecialchars($currentValues['email']) ?>" <?php endif ; ?> required>
          </div>
          <?php if(isset($error['email'])) : ?>
            <p class="text-danger"><i class="bi bi-exclamation-circle p-1"></i><?= htmlspecialchars($error['email']) ?></p>
          <?php endif; ?>
        </div>
  
        <div class="col-md-6">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control <?php if(isset($error['password'])) : ?> border border-danger <?php endif; ?>" id="password" name="password" placeholder="Your password" required>
          <?php if(isset($error['password'])) : ?>
            <p class="text-danger"><i class="bi bi-exclamation-circle p-1"></i><?= htmlspecialchars($error['password']) ?></p>
          <?php endif; ?>
        </div>
        <div class="col-md-6">
          <label for="password-confirm" class="form-label">Password confirm</label>
          <input type="password" class="form-control <?php if(isset($error['password-confirm'])) : ?> border border-danger <?php endif; ?>" id="password-confirm" name="password-confirm" placeholder="Your password confirm" required>
          <?php if(isset($error['password-confirm'])) : ?>
            <p class="text-danger"><i class="bi bi-exclamation-circle p-1"></i><?= htmlspecialchars($error['password-confirm']) ?></p>
          <?php endif; ?>
        </div>
  
        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input <?php if(isset($error['agree'])) : ?> border border-danger <?php endif; ?>" type="checkbox" value="" id="invalidCheck" name="agree" required>
            <label class="form-check-label" for="invalidCheck">
              Agree to terms and conditions
            </label>
          </div>
          <?php if(isset($error['agree'])) : ?>
            <p class="text-danger"><i class="bi bi-exclamation-circle p-1"></i><?= htmlspecialchars($error['agree']) ?></p>
          <?php endif; ?>
        </div>

        <button class="btn btn-primary col-3 mx-auto mt-4" type="submit">Register</button>
      </form>
    </article>
</section>