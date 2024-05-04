{% extends "base.mvc.php" %}
{% block title %}Плащания по кредит{% endblock %}
{% block body %}

<?php
// Get messages from the session
$message = $_SESSION['message'] ?? null;
$withdraw_remaining_amount_message = $_SESSION['withdraw_remaining_amount_message'] ?? null;

// Clear the messages from the session so they are no longer displayed
unset($_SESSION['message']);
unset($_SESSION['withdraw_remaining_amount_message']);

// Get the errors from the session
$errors = $_SESSION['validation_errors'] ?? [];
// Clear the errors from the session so they are no longer displayed
unset($_SESSION['validation_errors']);
?>
?>

<h1>Плащания по кредит</h1>
<hr>

<h2>Информация за кредита:</h2>
<table border="1" class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Сума</th>
        <th>Срок</th>
        <th>Месечна вноска</th>
        <th>Оставаща сума</th>
        <th>Крайна дата</th>
        <!-- Добавете други полета на кредита по ваше усмотрение -->
    </tr>
    <tr>
        <td><?php echo $credit["id"]; ?></td>
        <td><?php echo $credit["amount"]; ?> лв.</td>
        <td><?php echo $credit["term"]; ?></td>
        <td><?php echo $credit["monthly_installment"]; ?> лв.</td>
        <td><?php echo $credit["remaining_amount"]; ?> лв.</td>
        <td><?php echo date("d F Y", strtotime($credit["end_term_date"])) ?></td>
        <!-- Добавете стойности за други полета на кредита -->
    </tr>
</table>

<h2>Плащания:</h2>

<table border="1" class="table table-bordered">
    <tr>
        <th>Плащане №</th>
        <th>Сума</th>
        <th>Дата</th>
        <!-- Добавете други полета за плащането по ваше усмотрение -->
    </tr>
    <?php if (empty($payments)): ?>
        <tr>
            <td class="text-center" colspan="3">Няма налични данни за плащания.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($payments as $payment): ?>
            <tr>
                <td><?php echo $payment["id"]; ?></td>
                <td><?php echo $payment["amount"]; ?> лв.</td>
                <td><?php echo date("d F Y", strtotime($payment["repayment_date"])); ?></td>
                <!-- Добавете стойности за други полета за плащането -->
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>


<?php if ($message): ?>
    <div class="alert alert-info col-12" role="alert">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<?php if ($withdraw_remaining_amount_message): ?>
    <div class="alert alert-info col-12" role="alert">
        <?php echo $withdraw_remaining_amount_message; ?>
    </div>
<?php endif; ?>


<?php if ($credit["remaining_amount"] <= 0): ?>
    <div class="alert alert-success" role="alert">
        Всички вноски са вече погасени за този кредит.
    </div>
<?php else: ?>
    <h2>Форма за погасяване на кредита:</h2>

    <form action="/credits/<?php echo $credit['id']; ?>/payments/store" method="post" style="display:flex; flex-wrap:wrap">
        <input type="hidden" name="credit_id" value="<?php echo $credit['id']; ?>">
        <div class="mr-2"> 
            <label for="amount">Сума за погасяване:</label>
            <input 
                type="text" 
                class="form-control" 
                value="<?php echo $credit['monthly_installment']; ?>" 
                id="amount" 
                name="amount"
                min="<?php echo $credit['monthly_installment']; ?>"  
            />
            <?php if (isset($errors["amount"])): ?>
                <p class="text-danger"><?php echo $errors["amount"]; ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="amount">Дата на погасяване:</label>
            <input type="date" class="form-control" id="date" name="date" />
            <?php if (isset($errors["date"])): ?>
                <p class="text-danger"><?php echo $errors["date"]; ?></p>
            <?php endif; ?>
        </div>
        <div class="col-12 mt-2 pl-0 mb-5">
            <button type="submit" class="btn btn-primary">Създай вноска</button>
        </div>
    </form>
<?php endif; ?>


{% endblock %}
