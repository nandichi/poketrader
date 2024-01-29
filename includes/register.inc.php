<div class="container mx-auto mt-5">
    <div class="flex justify-center">
        <div class="w-96">
            <?php
            if (isset($_SESSION['notification'])) {
                echo '<p class="text-red-500">' . $_SESSION['notification'] . '</p>';
                unset($_SESSION['notification']);
            }
            ?>
            <form action="../php/register.php" method="post">
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-600">Name:</label>
                    <input type="text" class="form-input mt-1 block w-full" id="username" name="username" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email:</label>
                    <input type="email" class="form-input mt-1 block w-full" id="email" name="email" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-600">Password:</label>
                    <input type="password" class="form-input mt-1 block w-full" id="password" name="password" required>
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-600">Confirm Password:</label>
                    <input type="password" class="form-input mt-1 block w-full" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Register</button>
            </form>
        </div>
    </div>
</div>
