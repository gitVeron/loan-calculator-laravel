<!DOCTYPE html>
<html>
<head>
    <title>Loan Calculator</title>
</head>
<body>
    <h1>Кредитный калькулятор</h1>
    <form method="POST" action="/api/loan/schedule">
        @csrf
        <label>Сумма:</label>
        <input type="number" name="amount" value="100000"><br>

        <label>Ставка (%):</label>
        <input type="number" name="rate" value="12"><br>

        <label>Месяцы:</label>
        <input type="number" name="months" value="6"><br>

        <label>Type:</label>
        <select name="type">
            <option value="annuity">Annuity</option>
            <option value="diff">Diff</option>
        </select><br>

        <button type="submit">Calculate</button>
    </form>
</body>
</html>