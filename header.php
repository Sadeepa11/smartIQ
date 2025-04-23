<!-- <!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body>

    <div class="col-12">
        <div class="row mt-1 mb-1">

            <div class="offset-lg-1 col-12 col-lg-3 align-self-start mt-2"> -->

                <!-- <?php

                        session_start();

                        if (isset($_SESSION["u"])) {

                            $data = $_SESSION["u"];

                        ?> -->


                <!-- <span class="text-lg-start"><b>Welcome </b><?php echo $data["fname"]; ?></span> | -->
                <!-- <span class="text-lg-start fw-bold signout" onclick="signout();">Sign Out</span> | -->

            <!-- <?php

                        } else {

            ?>

                <a href="auth.php" class="text-decoration-none fw-bold">Sign In or Register</a> |

            <?php

                        }

            ?> -->
<!-- 
            <span class="text-lg-start">Welcome to our shop</span> |


            <a class="text-lg-start fw-bold text-decoration-none" 
   style="cursor: pointer;" 
   href="https://wa.me/94710985131" 
   target="_blank">
   Help and Contact
</a> -->


            <!-- </div> -->

            <!-- <div class="col-12 col-lg-3 offset-lg-5 align-self-end" style="text-align: center;">
                <div class="row">

                    <div class="col-1 col-lg-3 mt-2">
                        <span class="text-start fw-bold">Sell</span>
                    </div>

                    <div class="col-12 col-lg-6 dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            My SmartIQ
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="userProfile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="#">My Sellings</a></li> -->
                            <!-- <li><a class="dropdown-item" href="myProducts.php">My Products</a></li>
                            <li><a class="dropdown-item" href="watchlist.php">Watchlist</a></li>
                            <li><a class="dropdown-item" href="purchasingHistory.php">Purchase History</a></li>
                            <li><a class="dropdown-item" href="messages.php">Messages</a></li> -->
                            <!-- <li><a class="dropdown-item" href="#" onclick="contactAdmin('<?php echo $_SESSION['u']['email']; ?>');">
                                    Contact Admin
                                </a></li> -->
                        <!-- </ul>
                    </div> -->

                    <!-- <div class="col-1 col-lg-3 ms-5 ms-lg-0 mt-1 cart-icon" onclick="window.location='cart.php';"></div> -->

                    <!-- msg modal -->
                    <!-- <div class="modal" tabindex="-1" id="contactAdmin">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Contact Admin</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div> -->
                                <!-- <div class="modal-body overflow-scroll"> -->
                                    <!-- received -->
                                    <!-- <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-8 rounded bg-success">
                                                <div class="row">
                                                    <div class="col-12 pt-2">
                                                        <span class="text-white fw-bold fs-4">Hello there!!!</span>
                                                    </div>
                                                    <div class="col-12 text-end pb-2">
                                                        <span class="text-white fs-6">2025-11-9 00:00:00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- received -->
                                    <!-- sent -->
                                    <!-- <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="offset-4 col-8 rounded bg-primary">
                                                <div class="row">
                                                    <div class="col-12 pt-2">
                                                        <span class="text-white fw-bold fs-4">Hello there!!!</span>
                                                    </div>
                                                    <div class="col-12 text-end pb-2">
                                                        <span class="text-white fs-6">2025-11-9 00:00:00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- sent -->
                                <!-- </div>
                                <div class="modal-footer">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="msgtxt" />
                                            </div>
                                            <div class="col-3 d-grid">
                                                <button type="button" class="btn btn-primary" onclick="sendAdminMsg();">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!--  -->

                <!-- </div>
            </div> 

        </div>
    </div>


    <script src="script.js"></script>
</body>

</html> -->


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <style>
        .top-nav {
            background: #ffffff;
            padding: 0.75rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }

        .welcome-text {
            color: #2d3748;
            font-size: 1.5rem;
        }

        .nav-link {
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
            border-radius: 0.375rem;
        }

        .nav-link:hover {
            color: #2b6cb0;
            background: #ebf4ff;
        }

        .help-contact {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            color: #2b6cb0;
            font-weight: 500;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }

        .help-contact:hover {
            background: #ebf4ff;
            color: #1a4971;
        }

        .chat-modal {
            border-radius: 1rem;
            overflow: hidden;
        }

        .chat-message {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin: 0.5rem 0;
        }

        .chat-input {
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.75rem;
            transition: all 0.2s ease;
        }

        .chat-input:focus {
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
            outline: none;
        }

        .send-button {
            background: #4299e1;
            color: white;
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .send-button:hover {
            background: #3182ce;
            transform: translateY(-1px);
        }

      
    </style>
</head>
<body>
    <nav class="top-nav">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="welcome-text fw-bold" style="fontHead">Welcome to SmartIQ</span>
                        <span class="text-muted">|</span>
                        <a href="https://wa.me/94710985131" 
                           target="_blank" 
                           class="help-contact">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-headset" viewBox="0 0 16 16">
                                <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5"/>
                            </svg>
                            Help and Contact
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Chat Modal -->
    <div class="modal fade" tabindex="-1" id="contactAdmin">
        <div class="modal-dialog">
            <div class="modal-content chat-modal">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold">Contact Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4" style="max-height: 400px; overflow-y: auto;">
                    <!-- Received message -->
                    <div class="chat-message bg-light">
                        <div class="fw-medium mb-1">Hello there!</div>
                        <div class="text-muted small">2025-11-9 00:00:00</div>
                    </div>
                    
                    <!-- Sent message -->
                    <div class="chat-message bg-primary bg-opacity-10 ms-auto" style="max-width: 80%;">
                        <div class="fw-medium mb-1">Hi! How can I help you today?</div>
                        <div class="text-muted small text-end">2025-11-9 00:00:00</div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 p-3">
                    <div class="container-fluid">
                        <div class="row g-2">
                            <div class="col-9">
                                <input type="text" class="chat-input w-100" id="msgtxt" placeholder="Type your message..."/>
                            </div>
                            <div class="col-3">
                                <button type="button" class="send-button w-100" onclick="sendAdminMsg();">
                                    Send
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>