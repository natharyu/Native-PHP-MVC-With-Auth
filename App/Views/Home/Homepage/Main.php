<section id="home">

        <?php if( isset( $_GET['error'] ) ) : ?>
            <p class="alert alert-danger" role="alert"><?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>

        <?php if( isset( $_GET['success'] ) ) : ?>
            <p class="alert alert-success" role="alert"><?= htmlspecialchars($_GET['success']) ?></p>
        <?php endif; ?>

        <article>
            <h1 class="text-center mb-4">Home Page</h1>
            <div class="card col-8 mx-auto shadow mb-4">
                <h5 class="card-header">Welcome !</h5>
                <div class="card-body">
                    <h5 class="card-title">Welcome to this MVC skeleton</h5>
                    <p class="card-text">This MVC skeleton is full PHP native working with bootstrap V5.2</p>
                </div>
            </div>

            <div class="card col-8 mx-auto shadow">
                <div class="card-body">
                    <p class="card-text">If you want more information about this PHP MVC template click the link above.</p>
                    <a href="/about" class="card-link">About</a>
                </div>
            </div>
        </article>
    
</section>