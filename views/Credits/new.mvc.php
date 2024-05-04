{% extends "base.mvc.php" %}

{% block title %}Нов кредит{% endblock %}

{% block body %}

<div class="d-flex align-items-center justify-content-between">
    <h1>Нов кредит</h1>
    <a class="btn btn-primary" href="/">Назад</a>
</div>
<hr>
<form method="post" action="/credits/create" style="display:flex; flex-wrap: wrap;">

{% include "Credits/form.mvc.php" %}

</form>

{% endblock %}