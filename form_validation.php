<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form Validation Example</title>
    <style>
        .error {color: #FF0000;}
        .form-container {
            width: 50%;
            margin: 0 auto;
        }
        .form-group {margin-bottom: 20px;}
        label {display: inline-block; width: 100px;}
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="form-group">PHP Form Validation Example</h2>
        <?php
        $nameErr = $emailErr = $websiteErr = $genderErr = "";
        $name = $email = $website = $comment = $gender = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
            } else {
                $name = test_input($_POST["name"]);
                if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                    $nameErr = "Only letters and white space allowed";
                }
            }

            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else {
                $email = test_input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }

            $website = test_input($_POST["website"]);
            if (!empty($website) && !filter_var($website, FILTER_VALIDATE_URL)) {
                $websiteErr = "Invalid URL";
            }

            $comment = test_input($_POST["comment"]);

            if (empty($_POST["gender"])) {
                $genderErr = "Gender is required";
            } else {
                $gender = test_input($_POST["gender"]);
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $name;?>">
                <span class="error">* <?php echo $nameErr;?></span>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" value="<?php echo $email;?>">
                <span class="error">* <?php echo $emailErr;?></span>
            </div>
            <div class="form-group">
                <label for="website">Website:</label>
                <input type="text" id="website" name="website" value="<?php echo $website;?>">
                <span class="error"><?php echo $websiteErr;?></span>
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <input type="radio" id="female" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">
                <label for="female">Female</label>
                <input type="radio" id="male" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">
                <label for="male">Male
                    <span class="error">* <?php echo $genderErr;?></span>
                </label>
            </div>
            <input type="submit" name="submit" value="Submit">
        </form>

        <?php
        echo "<h2>Your Input:</h2>";
        echo "Name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: ".$name;
        echo "<br>";
        echo "E-mail &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: ".$email;
        echo "<br>";
        echo "Website &nbsp&nbsp&nbsp&nbsp: ".$website;
        echo "<br>";
        echo "Comment &nbsp: ".$comment;
        echo "<br>";
        echo "Gender  &nbsp&nbsp&nbsp&nbsp&nbsp: ".$gender;
        ?>
    </div>
</body>
</html>
