<!DOCTYPE html>
<html>
<head>
    <title>AutoHub - Review and Ratings</title>
    <link rel="icon" href="Images/Title logo.png" sizes="32x32" type="image/png"> <!-- Link to the favicon image -->
    <link rel="stylesheet" href="CSS/Review.css">
    <script>
        // Function to open the modal with review data
        function openModal(reviewId, currentReview) {
            console.log('Review ID:', reviewId); // Debugging line to log the review ID
            console.log('Current Review:', currentReview); // Debugging line to log the current review text
            document.getElementById('modal').style.display = 'flex'; // Open modal by setting its display to flex
            document.getElementById('reviewId').value = reviewId;    // Set the hidden review ID field with the review ID
            document.getElementById('reviewText').value = currentReview; // Populate the review textarea with the current review
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('modal').style.display = 'none'; // Close modal
        }

        // Close modal if clicked outside the modal content
        window.onclick = function(event) {
            let modal = document.getElementById('modal');
            if (event.target == modal) {
                modal.style.display = 'none'; // Close modal if clicking outside of it
            }
        }
    </script>

    <style>
        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            width: 50%;
            border-radius: 5px;
        }

        .close {
            float: right;
            font-size: 20px;
            cursor: pointer;
        }

        /* Modal Overlay */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top of other elements */
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.6); /* Black with opacity */
            display: flex; /* Flexbox for centering */
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Modal Content Box */
        .modal-content {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            max-width: 600px;
            width: 100%;
            position: relative; /* For close button positioning */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            animation: fadeIn 0.3s ease-in-out; /* Modal entrance animation */
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;/* Start fully transparent */
                transform: scale(0.8);/* Scale down */
            }
            to {
                opacity: 1;/* End fully opaque */
                transform: scale(1); /* Scale to normal size */
            }
        }

        /* Close button */
        .close {
            position: absolute;/* Position relative to the modal content */
            top: 10px;
            right: 15px;
            font-size: 25px;
            font-weight: bold;
            color: #333;
            cursor: pointer;
        }

        .close:hover {
            color: #ff0000;
        }

        /* Modal Heading */
        .modal-content h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            border-bottom: 2px solid #f2f2f2;
            padding-bottom: 10px;
        }

        /* Review Textarea */
        .modal-content textarea {
            width: 100%;
            height: 150px;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none; /* Disable resizing */
            box-sizing: border-box;
            margin-bottom: 20px;
            transition: border-color 0.3s ease;
        }

        /* Textarea focus effect */
        .modal-content textarea:focus {
            border-color: #007BFF; 
            outline: none;/* Remove default outline */
        }
    

        /* Submit button */
        .modal-content button {
            background-color: #007BFF; /* Blue background */
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        /* Button hover effect */
        .modal-content button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .modal-content {
                max-width: 100%;
                padding: 20px;
            }
            
            .modal-content h2 {
                font-size: 20px;
            }

            .modal-content textarea {
                height: 120px;
                font-size: 14px;
            }

            .modal-content button {
                font-size: 14px;
                padding: 10px 15px;
            }
        }

        /* Review Container Styles */
        .review-container {
            padding: 20px;
            background-color: #f9f9f9; /* Light background for contrast */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
            margin-top: 20px; /* Spacing above the review container */
        }

        /* Reviews Heading Styles */
        .review-container h2 {
            font-size: 28px; /* Larger font for heading */
            margin-bottom: 20px; /* Space below heading */
            color: #333; /* Darker color for text */
            text-align: center; /* Center align heading */
        }

        /* Review Box Styles */
        .review-box {
            background-color: #fff; /* White background for each review */
            border-radius: 8px; /* Rounded corners */
            padding: 15px; /* Inner spacing */
            margin-bottom: 15px; /* Space between reviews */
            transition: transform 0.2s; /* Smooth transition for hover effect */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        /* Review Textarea */
        #reviewText {
            width: 100%;
            height: 150px; /* Set a fixed height */
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 20px;
            transition: border-color 0.3s ease;
            overflow-y: auto; /* Enable vertical scrolling */
            resize: vertical; /* Allow vertical resize only */
        }

        /* Textarea focus effect */
        .modal-content textarea:focus {
            border-color: #007BFF; /* Blue border on focus */
            outline: none;
        }

        /* Review Box Hover Effect */
        .review-box:hover {
            transform: translateY(-5px); /* Slight lift effect on hover */
        }

        /* Review Name Styles */
        .review-box h3 {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0 0 10px; /* Margin below name */
            font-size: 22px; 
            color:#0056b3; 
        }

        /* Review Text Styles */
        .review-box p {
            font-size: 16px; 
            color: #555; /* Slightly lighter color for text */
        }

        /* Button Styles */
        .review-box button {
            background-color: #007BFF; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            padding: 10px 15px; 
            cursor: pointer; 
            transition: background-color 0.3s; 
        }

        /* Button Hover Effect */
        .review-box button:hover {
            background-color: #0056b3; /* Darker color on hover */
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .review-container {
                padding: 15px; 
            }

            .review-box {
                padding: 10px; 
            }

            .review-box h3 {
                font-size: 20px; 
            }

            .review-box p {
                font-size: 14px; 
            }

            .review-box button {
                padding: 8px 12px; /* Smaller button padding */
                font-size: 14px; /* Smaller font size for buttons */
            }
        }


    </style>

</head>
<body>
    <div class="page-container">
        <div class="content-wrap">
            <div class="nvbar">
                <a href="Home.html"><img class="Hlogo" src="Images/websitelogo.png" alt="webpage logo"></a>
                <ul id="nvgbar">
                    <li class="nvglist"><a href="Home.html">Home</a></li>
                    <li class="nvglist"><a href="AdsPg.html">Ads</a></li>
                    <li class="nvglist"><a href="Support.html">Support</a></li>
                    <li class="nvglist"><a class="active" href="#">About us</a></li>
                    <li class="nvglist"><a href="Contact.html">Contact us</a></li>
                    <li class="nvglist"><a href="login.php">Login</a></li>
                </ul>
                <a href="Profile.html"> <img class="Flogo" src="Images/profile logo.png" alt="profile logo"> </a>
            </div>

            <!-- Review Section -->
            <div class="review-container">
                <form action="Review-Insert.php" method="post" class="review-form">
                    <h1>Submit Your Review</h1>
                    <input type="email" class="rew-email" name="remail" placeholder="Enter email" required><br>
                    <input type="text" class="rew-name" name="rname" placeholder="Enter Name" required><br>
                    <textarea id="reviewText" name="review" rows="4" cols="50" placeholder="Write your review here...." required></textarea>
                    <button type="submit" class="sub-btn">Submit</button>
                </form>

                <!-- Reviews display Section -->
                <div class="reviews" id="reviewsSection">
                    <h2>Reviews Section</h2>

                    <?php
                    include 'Review-Config.php'; 

                    $sql = "SELECT name, review, email FROM review_details";
                    $result = $rew->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='review-box'>";
                            echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                            echo "<p>" . htmlspecialchars($row['review']) . "</p>";
                            echo "<button onclick=\"openModal('" . htmlspecialchars($row['email']) . "', '" . htmlspecialchars(addslashes($row['review'])) . "')\">Edit</button>";
                            echo "<form action='Review-Delete.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='email' value='" . htmlspecialchars($row['email']) . "'>
                                    <button type='submit' onclick='return confirm(\"Are you sure you want to delete this review?\");'>Delete</button>
                                </form>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No reviews yet. Be the first to leave one!</p>";
                    }

                    $rew->close();
                    ?>
                </div>
            </div>
        </div>

        <!-- Modal for editing review -->
        <div id="modal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Edit Review</h2>
                <form action="Review-Update.php" method="post">
                    <input type="hidden" id="reviewId" name="email"> <!-- Hidden field for email (unique identifier) -->
                    <textarea id="reviewText" name="review" rows="4" cols="50"></textarea><br>
                    <button type="submit">Update Review</button>
                </form>
            </div>
        </div>

        <!-- Footer Section -->
        <footer class="footer">
            <div class="box-container">
                <div class="box">
                    <h3>About us</h3>
                    <a href="AboutUS.html">About us</a>
                    <a href="AboutUS.html">Our community</a>
                </div>
                <div class="box">
                    <h3>Support</h3>
                    <a href="Contact.html">24 hours contact center</a>
                    <a href="Support.html">FAQs</a>
                </div>
                <div class="box">
                    <h3>Terms and Conditions</h3>
                    <a href="terms&condition.html">General</a>
                    <a href="terms&condition.html">Copyright</a>
                </div>
                <div class="follow-us-container">
                    <h3>Follow Us</h3>
                    <a href="#"><img src="Images/facebook icon.png" alt="Facebook" class="social-link"></a>
                    <a href="#"><img src="Images/twitter icon.png" alt="Twitter" class="social-link"></a>
                    <a href="#"><img src="Images/instragram icon.png" alt="Instagram" class="social-link"></a>
                </div>
            </div>
            <h1 class="credit"><span>@ 2022 All Rights Reserved</span></h1>
        </footer>
    </div>
</body>
</html>
