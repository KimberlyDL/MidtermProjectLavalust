<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hello Kim</title>
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", sans-serif;
            background: #f8fafc;
            color: #334155;
        }

        .container {
            max-width: 960px;
            margin: 3rem auto;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .header {
            background: #3B82F6;
            /* lighter blue */
            color: #ffffff;
            padding: 2rem;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        .main {
            padding: 2rem;
        }

        h2 {
            color: #1e40af;
            margin-top: 2rem;
        }

        p {
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        code,
        pre {
            display: block;
            background: #f1f5f9;
            padding: 1rem;
            border-left: 4px solid #3b82f6;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #1e293b;
            overflow-x: auto;
        }

        ul {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }

        li {
            margin-bottom: 0.5rem;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .footer {
            font-size: 0.9rem;
            text-align: center;
            padding: 1rem;
            background: #f1f5f9;
            border-top: 1px solid #e2e8f0;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1rem;
        }

        .card {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .card h3 {
            margin-top: 0;
            color: #0f172a;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>
                <?php
                if (isset($fname)) {
                    echo "Profile";
                } else {
                    echo "Get Id";
                }
                ?>
            </h1>
        </div>

        <div class="main">
            <?php
            if (isset($fname) && isset($lname)) {
                echo $fname . " " . $lname;
            } else {
                echo $id . " " . $name;
            }
            ?>
        </div>
    </div>
</body>

</html>