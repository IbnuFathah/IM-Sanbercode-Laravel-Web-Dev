<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form method="POST" action="/kirim">
         @csrf
        <header>
            <h1>Buat Account</h1>
            <h2>Sign Up Form</h2>
        </header>
        <main>
            <label type>First name:</label><br>
            <input type="text" name="firstName" required minlength="2" maxlength="50"><br><br>
            <label>Last name:</label><br>
            <input type="text" name="lastName" required minlength="2" maxlength="50"><br><br>
            <label>Gender:</label><br>
            <input type="radio" name="gender" value="Male" required>Male <br>
            <input type="radio" name="gender" value="Female" required>Female <br><br>
            <label>Nationality:</label><br>
            <select>
                <option value="">Indonesia</option>
                <option value="">Jepang</option>
                <option value="">Arab</option>
            </select><br><br>
            <label>Language Spoken:</label><br>
            <input type="checkbox">Bahasa Indonesia <br>
            <input type="checkbox">English <br>
            <input type="checkbox">Other <br><br>
            <label>Bio:</label><br>
            <textarea name="bio" id=""></textarea><br>
            <button>Sign Up</button>
        </main>
    </form>
</body>
</html>