{% extends "base.mvc.php" %}
{% block title %}Кредити{% endblock %}
{% block body %}

<?php
// Вземане на съобщения от сесията
$message = $_SESSION['message'] ?? null;

// Изчистване на съобщенията от сесията, за да не се показват повече
unset($_SESSION['message']);
?>

<div class="d-flex align-items-center justify-content-between">
    <h1>Кредити - <?php echo $user['name']; ?></h1>
</div>
<hr>
<p>Total: <?php echo $total; ?></p>

<table border="1" class="table table-bordered">
    <tr>
        <th>Плащане №</th>
        <th>Сума</th>
        <th>Срок</th>
        <th>Месечна вноска</th>
        <th>Оставаща сума</th>
        <th>Платена сума</th>
        <th>Брой плащания</th>
        <th>Крайна дата</th>
        <th>Действия</th>
        <!-- Добавете други полета за плащането по ваше усмотрение -->
    </tr>
    <?php if (empty($credits)): ?>
    <tr>
        <td class="text-center" colspan="8">Няма налични данни</td>
    </tr>
    <?php else: ?>
        <?php foreach ($credits as $credit): ?>
            <tr>
                <td><?php echo $credit["id"]; ?></td>
                <td><?php echo $credit["amount"]; ?> лв.</td>
                <td><?php echo $credit["term"]; ?></td>
                <td><?php echo $credit["monthly_installment"]; ?> лв.</td>
                <td><?php echo $credit["remaining_amount"]; ?> лв</td>
                <td><?php echo $credit["paid_amount"]; ?></td>
                <td><?php echo $credit["payment_count"]; ?></td>
                <td><?php echo date("d F Y", strtotime($credit["end_term_date"])); ?></td>
                <td>
                    <a href="/credits/<?php echo $credit["id"]; ?>/new_payment" type="button">Направи плащане</a>
                    <form action="/credits/<?php echo $credit["id"]; ?>/delete" method="post" style="display: inline;">
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Сигурни ли сте, че искате да изтриете?')">Изтрий</button>
                    </form>
                </td>
                <!-- Добавете стойности за други полета за плащането -->
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>

</table>


{% endblock %}
