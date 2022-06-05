<section id="dashboard">

        <?php if( isset( $_GET['error'] ) ) : ?>
            <p class="alert alert-danger" role="alert"><?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>

        <?php if( isset( $_GET['success'] ) ) : ?>
            <p class="alert alert-success" role="alert"><?= htmlspecialchars($_GET['success']) ?></p>
        <?php endif; ?>

        <article>
            <h1 class="text-center mb-4">Admin Dashboard Page</h1>
            <div class="card col-8 mx-auto shadow mb-4">
                <h5 class="card-header">Welcome !</h5>
                <div class="card-body">
                    <h5 class="card-title">Welcome to the admin panel.</h5>
                    <p class="card-text">This admin panel is here for users manage</p>
                    <p class="card-text">You can manage users by click on 'Users' navbar button or on the link above</p>
                    <a href="/dashboard/users" class="card-link">Manage users</a>
                </div>
            </div>
        </article>
    
</section>