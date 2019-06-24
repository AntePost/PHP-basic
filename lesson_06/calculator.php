<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calculator</title>
</head>
<body>
    <form action="engine/calculator_logic.php" method="get">
        <label for="term_1">Term 1</label>
        <input type="text" name="term_1" id="term_1">
        <label for="term_2">Term 2</label>
        <input type="text" name="term_2" id="term_2">
        <!-- <input type="radio" name="operation" value="add">Addition
        <input type="radio" name="operation" value="sub">Subtraction
        <input type="radio" name="operation" value="mul">Multiplication
        <input type="radio" name="operation" value="div">Division -->
        <br>
        <input type="submit" name='operation' value='add'>
        <input type="submit" name='operation' value='sub'>
        <input type="submit" name='operation' value='mul'>
        <input type="submit" name='operation' value='div'>
        <br>
        <p id='result'>Calculate something!</p>
    </form>
</body>

<script>
    const cookies = document.cookie.split('; ');

    function findInCookies(cookies, str) {
        return cookies.find(el => {
            return el.includes(str);
        });
    }

    let result = findInCookies(cookies, 'result').split('=')[1];
    result = result.replace(/\+/g, ' ');
    
    document.getElementById('result').innerHTML = `Result is ${result}`;
</script>
</html>