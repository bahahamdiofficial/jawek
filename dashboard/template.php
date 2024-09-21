<?php include "./includes/header-start.php" ?>
<?php include "./includes/header-end.php" ?>
<?php include "./includes/footer-start.php" ?>
<?php include "./includes/footer-end.php" ?>


<!-- WHEN YOU WANT TO ADD ACTIONS LIKE EDIT DELETE STUFF -->
<div class="table-actions">
    <div class="label">
        <span class="material-symbols-outlined expand">
            expand_more
        </span>
        actions
    </div>

    <div class="drop-down">
        <a href=""></a>
    </div>
</div>

<!-- this is and error notification (red in  color) -->
<div class="note error">
    <span class="material-symbols-outlined">
        warning
    </span>
    <!-- content here -->
</div>

<!-- this is and error notification (yellow in  color) -->

<div class="note warning">
    <span class="material-symbols-outlined">
        error
    </span>
    <!-- content here -->
</div>

<!-- FORMS -->
<form action="">

    <!-- WHEN YOU WANT TO HAVE JUST ONE INPUT OR SELECT OR TEXT AREA -->
    <div class="input-group">
        <label>Name</label>
        <input type="text">
    </div>
    <div class="input-group">
        <label>Name</label>
        <select name="" id="">
            <option value=""></option>
        </select>
    </div>
    <div class="input-group">
        <label>Name</label>
        <textarea name="" id="" cols="30" rows="10"></textarea>
    </div>



    <!-- WHEN YOU WANT TO HAVE MULITPLE INPUTS SPAN HORIZONTALLY -->
    <div class="form-group">
        <div class="input-group">
            <label>Name</label>
            <input type="text">
        </div>
        <div class="input-group">
            <label>Name</label>
            <input type="text">
        </div>
    </div>


</form>


<!-- TABLES -->

<div class="table-container">
    <table>

        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>



    </table>
</div>