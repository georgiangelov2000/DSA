<?php
// Get messages from the session
$message = $_SESSION['message'] ?? null;

// Clear the messages from the session so they are no longer displayed
unset($_SESSION['message']);

// Вземане на грешките от сесията
$errors = $_SESSION['validation_errors'] ?? [];
// Clear the errors from the session so they are no longer displayed
unset($_SESSION['validation_errors']);
?>
<?php if ($message): ?>
    <div class="alert alert-info col-12" role="alert">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<div class="col-6 pl-0">
    <div class="form-group">
        <label for="recipient_name">Кредитополучатели:</label>
        <select name="user_id" id="user_id" class="form-control">
            <option value="">Избери опция</option>
            <?php foreach ($users as $user): ?>
                <option value='<?php echo $user["id"]; ?>'><?php echo $user["name"]; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="amount">Сума в лева:</label>
        <input 
            style="width:100%;" 
            type="number" 
            id="amount" 
            name="amount" 
            class="form-control"
            min="0.01" 
            step="0.01" 
            required 
        />
        <?php if (isset($errors["amount"])): ?>
            <p class="text-danger"><?php echo $errors["amount"]; ?></p>
        <?php endif; ?>
    </div>
</div>
<div class="col-6 pl-0">
    <div class="form-group">
        <label for="term">Срок в месеци (от 3 до 120):</label>
        <input style="width:100%;" type="number" id="term" name="term" class="form-control" min="3" max="120" required />
        <?php if (isset($errors["term"])): ?>
            <p class="text-danger"><?php echo $errors["term"]; ?></p>
        <?php endif; ?>
    </div>
</div>
<button type="submit" class="btn btn-primary">Създай кредит</button>
