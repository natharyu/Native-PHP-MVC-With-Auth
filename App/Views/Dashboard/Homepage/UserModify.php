<section id="userModify">

        <?php if( isset( $_GET['error'] ) ) : ?>
            <p class="alert alert-danger" role="alert"><?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>

        <?php if( isset( $_GET['success'] ) ) : ?>
            <p class="alert alert-success" role="alert"><?= htmlspecialchars($_GET['success']) ?></p>
        <?php endif; ?>

        <article class="col-8 card mx-auto p-4 my-5 shadow bg-body rounded">
      <h2 class="text-center pb-4">Modify <?php echo htmlspecialchars($user['username']) ?> user</h2>
      
      <form class="row g-3" method="POST" action="/dashboard/users/modify/validate" novalidate>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']) ?>">
        <div class="col-md-6">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control <?php if(isset($error['username'])) : ?> border border-danger <?php endif; ?>" id="username" name="username" <?php if(isset($currentValues['username'])) : ?> value="<?= htmlspecialchars($currentValues['username']) ?>"<?php else: ?> value="<?= htmlspecialchars($user['username'])?>"<?php endif ; ?> required>
          <?php if(isset($error['username'])) : ?>
            <p class="text-danger"><i class="bi bi-exclamation-circle p-1"></i><?= htmlspecialchars($error['username']) ?></p>
          <?php endif; ?>
        </div>
        <div class="col-md-6">
          <label for="email" class="form-label">Email</label>
          <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend">@</span>
            <input type="text" class="form-control <?php if(isset($error['email'])) : ?> border border-danger <?php endif; ?>" id="email" name="email" aria-describedby="inputGroupPrepend" <?php if(isset($currentValues['username'])) : ?> value="<?= htmlspecialchars($currentValues['email']) ?>"<?php else: ?> value="<?= htmlspecialchars($user['email'])?>"<?php endif ; ?> required>
          </div>
          <?php if(isset($error['email'])) : ?>
            <p class="text-danger"><i class="bi bi-exclamation-circle p-1"></i><?= htmlspecialchars($error['email']) ?></p>
          <?php endif; ?>
        </div>
  
        <div class="col-md-12">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" aria-label="role">
                <option value="<?php echo htmlspecialchars($user['role']) ?>" selected>Select role</option>
                <option value="USER">USER</option>
                <option value="ADMIN">ADMIN</option>
            </select>          
            <?php if(isset($error['role'])) : ?>
            <p class="text-danger"><i class="bi bi-exclamation-circle p-1"></i><?= htmlspecialchars($error['password']) ?></p>
            <?php endif; ?>
        </div>

        <button class="btn btn-primary col-3 mx-auto mt-4" type="submit">Modify</button>
      </form>
    </article>
</section>