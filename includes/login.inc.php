<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="../php/login.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <button onclick="window.location.href='../index.php?page=register'" class="btn btn-primary mt-3">Register</button>
        </div>
    </div>
</div>
