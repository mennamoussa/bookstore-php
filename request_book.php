<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Book</title>
    <link rel="stylesheet" href="request-style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Request a Book</h1>
        <form id="requestForm">
            <label for="book_title">Book Title:</label>
            <input type="text" id="book_title" name="book_title" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>

            <label for="requester_name">Your Name:</label>
            <input type="text" id="requester_name" name="requester_name" required>

            <button type="submit">Submit Request</button>
        </form>
        <div id="responseMessage"></div>
    </div>

    <script>
        $(document).ready(function () {
            $("#requestForm").on("submit", function (e) {
                e.preventDefault();

                $.ajax({
                    url: "process_request.php",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        $("#responseMessage").html("<p>" + response + "</p>");
                    },
                    error: function () {
                        $("#responseMessage").html("<p>Error submitting request. Please try again.</p>");
                    }
                });
            });
        });
    </script>
</body>
</html>
