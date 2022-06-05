<section id="users">

        <?php if( isset( $_GET['error'] ) ) : ?>
            <p class="alert alert-danger" role="alert"><?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>

        <?php if( isset( $_GET['success'] ) ) : ?>
            <p class="alert alert-success" role="alert"><?= htmlspecialchars($_GET['success']) ?></p>
        <?php endif; ?>

        <article>
            <h1 class="text-center mb-4">Users Page</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                    <tr>
                        <th scope="row"><?php echo $user['id'] ?></th>
                        <td><?php echo $user['username'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['role'] ?></td>
                        <td>
                            <a href="/dashboard/users/modify?id=<?php echo $user['id'] ?>" class="btn btn-warning">Modify</a>
                            <a href="/dashboard/users/delete?id=<?php echo $user['id'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </article>
    
</section>