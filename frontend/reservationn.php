<!doctype html>
<html>
<head>
    <title>Reservation</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: auto;
            width: 100vw;
            height: 80vh;
            background: #ecf0f3;
            display: flex;
            align-items: center;
            text-align: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
           
        }

        .container {
            position: absolute;
            width: 350px;
            height: auto;
            border-radius: 10px;
            padding: 40px;
            box-sizing: border-box;
            background: #ecf0f3;
            box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
        }

        .brand-logo {
            height: 100px;
            width: 100px;
            background: url("../../images/Gallery Cafe1.png"); 
            background-size: 100px;
            margin: auto;
            border-radius: 10%;
            box-shadow: 7px 7px 10px #cbced1, -7px -7px 10px white;
        }

        .brand-title {
            margin-top: 10px;
            font-weight: 500;
            font-size: 1.8rem;
            color: #d35400;
            letter-spacing: 1px;
        }

        .inputs {
            text-align: left;
            margin-top: 20px;
        }

        label,
        input,
        textarea,
        button {
            display: block;
            width: 100%;
            padding: 0;
            border: none;
            outline: none;
            box-sizing: border-box;
        }

        label {
            margin-bottom: 2px;
            font-weight: normal;
        }

        input::placeholder {
            color: gray;
        }

        input,
        textarea {
            background: #ecf0f3;
            padding: 10px;
            font-size: 14px;
            border-radius: 50px;
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
            margin-bottom: 20px;
        }

        textarea {
            border-radius: 10px;
            resize: vertical;
        }

        button {
            margin-top: 20px;
            background: #f39c12;
            height: 40px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 900;
            box-shadow: 6px 6px 6px #cbced1, -6px -6px 6px white;
            transition: 0.5s;
            color: #ecf0f3;
        }

        button:hover {
            box-shadow: none;
        }

        .error {
            color: #eb2f06;
            font-size: 12px;
        }
    </style>
    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var phone = document.getElementById("phone").value;
            var date = document.getElementById("date").value;
            var time = document.getElementById("time").value;
            var guest = document.getElementById("guests").value;
            var errors = false;

            // Clear previous errors
            document.querySelectorAll('.error').forEach(e => e.textContent = '');

            if (name === '') {
                document.getElementById("name-error").textContent = "Name is required.";
                errors = true;
            }
            if (email === '') {
                document.getElementById("email-error").textContent = "Email is required.";
                errors = true;
            }
            if (phone === '') {
                document.getElementById("phone-error").textContent = "Phone number is required.";
                errors = true;
            }
            if (date === '') {
                document.getElementById("date-error").textContent = "Date is required.";
                errors = true;
            }
            if (time === '') {
                document.getElementById("time-error").textContent = "Time is required.";
                errors = true;
            }
            if (guest === '' || guest < 1) {
                document.getElementById("guests-error").textContent = "Number of guests must be at least 1.";
                errors = true;
            }

            return !errors;
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="brand-logo"></div>
        <h2 class="brand-title">Book a Table</h2>
        <form method="POST" action="" class="reservation-form" onsubmit="return validateForm()">
            <div class="inputs">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <div id="name-error" class="error"></div>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <div id="email-error" class="error"></div>

                <label for="phone">Phone No:</label>
                <input type="tel" id="phone" name="phone" required>
                <div id="phone-error" class="error"></div>

                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
                <div id="date-error" class="error"></div>

                <label for="time">Time:</label>
                <input type="time" id="time" name="time" required>
                <div id="time-error" class="error"></div>

                <label for="guests">Number of Guests:</label>
                <input type="number" id="guests" name="guest" min="1" max="20" required>
                <div id="guests-error" class="error"></div>

                <label for="requests">Special Requests:</label>
                <textarea id="requests" name="request" rows="3" placeholder="Let us know if you have any special requests..."></textarea>
                
                <button type="submit">Confirm Reservation</button>
            </div>
        </form>
    </div>

    <?php
    $connection = mysqli_connect('localhost', 'root', '', 'gallery_cafe');

    if (mysqli_connect_error()) {
        die('Database connection failed: ' . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $phone = mysqli_real_escape_string($connection, $_POST['phone']);
        $date = mysqli_real_escape_string($connection, $_POST['date']);
        $time = mysqli_real_escape_string($connection, $_POST['time']);
        $guest = mysqli_real_escape_string($connection, $_POST['guest']);
        $request = mysqli_real_escape_string($connection, $_POST['request']);

        $query = "INSERT INTO reservation (name, email, phone, date, time, guest, request) 
                  VALUES ('$name', '$email', '$phone', '$date', '$time', '$guest', '$request')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            echo "<p style='color:green;text-align:center;'>Reservation recorded successfully.</p>";
        } else {
            echo "<p style='color:red;text-align:center;'>Error: " . mysqli_error($connection) . "</p>";
        }
    }

    mysqli_close($connection);
    ?>
</body>
</html>
