<?php 

require_once '../../includes/team.php';
require_once '../../includes/helpers.php';
require_once '../../includes/config.php';


$team = new Team($db);

$error = '';

if ($_POST && isset($_POST['create__team'])) {
    $team->name = $_POST['team__name'];
    $team->position = $_POST['team__position'];
    $team->description = $_POST['team__description'];
    $team->image = uploadImage($_FILES['team__image']);

    if ($team->image == false) {
        $error = 'Image upload failed';
    } else {
        if ($team->create()) {
            header('Location: team.php');
        } else {
            $error = 'Something went wrong. Please try again.';
        }
    }

}

$team = $team->read();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Team | Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/team.css">
</head>
<body>
    <?php include_once 'sidebar.php' ?>
    <section class="home-section">
        <?php include_once 'shared_dash.php' ?>
        <div class="home-content">
            <?php include_once 'overview_boxes.php' ?>
            <!-- create two divs, one div on left which has a products form then on right a table containing products -->
            <div class="team-boxes">
                <div class="new__team__container">
                    <div class="new__team__form">
                        <?php if ($error) : ?>
                            <div class="error__alert">
                                <p><?php echo $error ?></p>
                            </div>
                        <?php endif; ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form__group">
                                <label for="team__name">Name</label>
                                <input type="text" name="team__name" id="team__name" placeholder="Enter team member name">
                            </div>
                            <div class="form__group">
                                <label for="team__position">Position</label>
                                <input type="text" name="team__position" id="team__position" placeholder="Enter team member position">
                            </div>
                            <div class="form__group">
                                <label for="team__description">Description</label>
                                <textarea name="team__description" id="team__description" cols="30" rows="10" placeholder="Enter team member description"></textarea>
                            </div>
                            <div class="form__group">
                                <label for="team__image">Image</label>
                                <input type="file" name="team__image" id="team__image">
                            </div>
                            <div class="form__group">
                                <button type="submit" name="create__team">Create Team Member</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="team__table__container">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($team as $member) : ?>
                                <tr>
                                    <td><img src="../../images/team/<?php echo $member['image'] ?>" alt=""></td>
                                    <td><?php echo $member['name'] ?></td>
                                    <td><?php echo $member['position'] ?></td>
                                    <td><?php echo $member['description'] ?></td>
                                    <td>
                                        <a href="edit_team.php?id=<?php echo $member['id'] ?>" class="edit__team__btn">Edit</a>
                                        <a href="delete_team.php?id=<?php echo $member['id'] ?>" class="delete__team__btn">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
    </section>
</body>