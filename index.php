<?php
// error_reporting(0);

require dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."AOCD4".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."VenusFuelDepot.php";
use APP\VenusFuelDepot;

    $first_result= "";
    $second_result = "";

    if(isset($_POST['submit'])){
        $vfd = new VenusFuelDepot();
        $first_result = $vfd->part_one(trim($_POST['startRange']), trim($_POST['endRange']));
        $second_result = $vfd->part_two(trim($_POST['startRange']), trim($_POST['endRange']));
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.0/css/bulma.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Concert+One|Itim|Molengo&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <title>AOC4 - JIde Creppy</title>

    <style>
    
    .navbar-item h1 {
        margin-left:10px; 
        font-weight:700;
        font-family: Itim;
        font-size:20px;
        max-width:60%;
    }

    .section .container {
        display:flex;
        flex-wrap: wrap; 
        justify-content: space-evenly
    }

    .container .card {
        min-width: 400px;
        font-family: Itim
    }

    .results-container {
        margin-top:40px;
        color:red;
    }

    .results-container h2 {
        color:red;
    }

    .results-container p {
        display:inline-block
    }

    </style>
</head>

<body>
    <div class="container is-fluid">
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="https://github.com/jideCreppy/AOC4" target="__blank">
                    <h1>
                        ADVENT OF CODE: 04/12/2019 (Jide Creppy)
                    </h1>
                </a>
            </div>
        </nav>
    </div>
    <section class="section">
        <div class="container">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Password Range</p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <form action="" method="post">
                            <div class="field">
                                <label class="label">Start</label>
                                <div class="control">
                                    <input class="input" type="text" name="startRange">
                                </div>
                                <p class="help">Range Start: <strong>254032</strong> </p>
                            </div>
                            <div class="field">
                                <label class="label">End</label>
                                <div class="control">
                                    <input class="input" type="text" name="endRange">
                                </div>
                                <p class="help">Range End - <strong>789860</strong></p>
                            </div>
                            <div class="field">
                                <button type="submit" name="submit" class="button is-info">Submit</button>
                            </div>
                        </form>
                            <?php
                            
                                if(!empty($first_result) || !empty($second_result)){
                                    echo "<div class='results-container animated flash'>";
                                    echo "<h2>Results:</h2>";
                                    echo "<p>$first_result</p>";
                                    echo "<br/>";
                                    echo "<p>$second_result</p>";
                                    echo "</div>";
                                }

                            ?> 
                    </div>
                </div>
            </div>
            <div class="card" style="width:50%;font-family: Itim">
                <header class="card-header">
                    <p class="card-header-title"><a href="https://adventofcode.com/2019/day/4"><i class="fas fa-link"></i> Secure Container (The
                            Venus fuel depot)</a></p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <div class="box">
                            <article class="media">
                                <div class="media-content">
                                    <div class="content">
                                        <div style="font-size: 14px;overflow: auto; height:200px">
                                            <p style="margin: 0 0 10px 0; font-size:16px; font-weight: bold">Part 1</p>

                                            You arrive at the Venus fuel depot only to discover it's protected by a
                                            password. The Elves had written the password on a sticky note, but someone
                                            threw it out.

                                            However, they do remember a few key facts about the password:
                                            <ul>
                                                <li>It is a six-digit number.</li>
                                                <li>The value is within the range given in your puzzle input.</li>
                                                <li>Two adjacent digits are the same (like 22 in 122345).</li>
                                                <li>Going from left to right, the digits never decrease; they only ever
                                                    increase</li>
                                                or stay the same (like 111123 or 135679).
                                            </ul>
                                            Other than the range rule, the following are true:

                                            111111 meets these criteria (double 11, never decreases).
                                            223450 does not meet these criteria (decreasing pair of digits 50).
                                            123789 does not meet these criteria (no double).
                                            How many different passwords within the range given in your puzzle input
                                            meet these criteria?
                                        </div>
                                        <div
                                            style="font-size: 14px;overflow: auto; height:200px; margin-top:30px;border-top: 1px solid gray;padding-top: 25px">
                                            <p style="margin: 0 0 10px 0; font-size:16px; font-weight: bold">Part 2</p>

                                            An Elf just remembered one more important detail: the two adjacent matching
                                            digits are not part of a larger group of matching digits.

                                            Given this additional criterion, but still ignoring the range rule, the
                                            following are now true:
                                            <ul>
                                                <li>112233 meets these criteria because the digits never decrease and
                                                    all repeated digits are exactly two digits long.</li>
                                                <li>123444 no longer meets the criteria (the repeated 44 is part of a
                                                    larger group of 444).</li>
                                                <li>111122 meets the criteria (even though 1 is repeated more than
                                                    twice, it still contains a double 22).</li>
                                            </ul>
                                            How many different passwords within the range given in your puzzle input
                                            meet all of the criteria?
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>