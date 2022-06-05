<section id="contactForm">
    <article class="col-8 card mx-auto p-4 my-5 shadow bg-body rounded">
      <h2 class="text-center pb-4">Contact Us</h2>

      <form class="row g-3" method="" action="">
        <div class="col-md-12">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control <?php if(isset($error['username'])) : ?> border border-danger <?php endif; ?>" id="username" name="username" placeholder="Your username" <?php if(isset($currentValues['username'])) : ?> value="<?= htmlspecialchars($currentValues['username']) ?>" <?php endif ; ?> required>
          <?php if(isset($error['username'])) : ?>
            <p class="text-danger"><i class="bi bi-exclamation-circle p-1"></i><?= htmlspecialchars($error['username']) ?></p>
          <?php endif; ?>
        </div>
        <div class="col-md-12">
          <label for="email" class="form-label">Email</label>
          <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend">@</span>
            <input type="text" class="form-control <?php if(isset($error['email'])) : ?> border border-danger <?php endif; ?>" id="email" name="email" placeholder="Your email" aria-describedby="inputGroupPrepend" <?php if(isset($currentValues['email'])) : ?> value="<?= htmlspecialchars($currentValues['email']) ?>" <?php endif ; ?> required>
          </div>
          <?php if(isset($error['email'])) : ?>
            <p class="text-danger"><i class="bi bi-exclamation-circle p-1"></i><?= htmlspecialchars($error['email']) ?></p>
          <?php endif; ?>
        </div>
  
        <div class="col-md-12">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" placeholder="Leave your message here" rows="5" id="message"></textarea>
        </div>

        <button class="btn btn-primary col-3 mx-auto mt-4" type="submit">Submit</button>
      </form>

    </article>
</section>