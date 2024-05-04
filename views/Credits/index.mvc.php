{% extends "base.mvc.php" %}

{% block title %}Кредити{% endblock %}

{% block body %}

<div class="d-flex align-items-center justify-content-between">
    <h1>Кредити</h1>
    <a class="btn btn-primary" href="/credits/new">Създай нов кредит</a>
</div>
<hr>
<p>Total: {{ total }}</p>

<?php
// Вземане на съобщения от сесията
$message = $_SESSION['message'] ?? null;

// Изчистване на съобщенията от сесията, за да не се показват повече
unset($_SESSION['message']);
?>

<?php if ($message): ?>
    <div class="alert alert-info col-12" role="alert">
        <?php echo $message; ?>
    </div>
<?php endif; ?>
<table border="1" class="table table-bordered">
    <thead>
        <tr>
            <th>Ид</th>
            <th>Име</th>
            <th>Обща сума на кредити</th>
            <th>Изплатена сума на кредити</th>
            <th>Брой кредити</th>
            <th>Лихвен процент</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
    <?php if (empty($users)): ?>
        <tr>
            <td class="text-center" colspan="6">Няма налични данни за плащания.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user["id"]; ?></td>
            <td><?php echo $user["name"]; ?></td>
            <td><?php echo $user["max_amount"]; ?> лв.</td>
            <td><?php echo $user["paid_amount"]; ?></td>
            <td><?php echo $user["credit_count"]; ?></td>
            <td>7.9%</td> <!-- Лихвеният процент за всички клиенти е 7.9% -->
            <td>
                <!-- Добавете тук връзка към формуляр за въвеждане на ново плащане по даден кредит -->
                <a href="/credits/<?php echo $user["id"]; ?>/show">Кредити</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>


{% endblock %}
