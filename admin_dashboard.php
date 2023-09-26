<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'cdn.php'; ?>
    <title>Delete Content | Audio Mass Podcast</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/edit_delete.css">
    <link rel="stylesheet" href="./css/dashboard.css">
</head>

<body>
    <div class="navbar-all">
        <div class="logo">

        </div>
        <div class="nav-btn">

        </div>
    </div>
    <div class="hero">
        <h1>Admin Dashboard</h1>
    </div>

    <section>
        <div class="dashboard-grid">
            <div class="grid-one">
                <h1> Add Audio Mass Podcast</h1>
                <button>
                    <a href="admin.php">Add Audio Mass Podcast</a>
                </button>
            </div>
            <div class="grid-one">
                <h1> Edit / Delete Audio Mass Podcast</h1>
                <button>
                    <a href="edit_delete.php">Edit/ Delete</a>
                </button>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="./javascript/authenticate.js"></script>
</body>

</html>