
                        <?php
                        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=design','phpuser','pass');
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        ?>
<!DOCTYPE html>
<html>
    <head>
            <script src="jquery.min.js"></script>
            <link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
            <link type="text/css" rel="stylesheet" href="css/canteen.css">
            <link type="text/css" rel="stylesheet" href="style2.css">
            <script>
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 1){
                        $('nav').addClass("sticky");
                    }
                    else{
                        $('nav').removeClass("sticky");
                    }
                });
            </script>
    </head>
<body class="" id="pagetop">

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">

        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#example-nav-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand"><span>&#127829</span>Canteen</a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="example-nav-collapse">
                <ul class="nav navbar-nav">
                    <li id="topn"><a href="logout.php" class="scroll">Logout</a></li>
                </ul>
                
            </div>
        </div>

    </nav>

<section id="canteenhead">
    <div class="col-md-12">
        <div class="head-inner">
            <h1><i class="fa fa-cutlery fa-6x"></i></h1>
            <h2> Order food online</h2>
            <h4 id="welcometext">Welcome to the canteen, user!</h4>    
        </div>
    </div>
        <ul class="nav nav-tabs wiz">
            <li class="active"><a aria-expanded="true" data-toggle="tab" href="#all">All</a></li>
                <?php
                    $cstmt= $pdo->query("SELECT * FROM category");
                    while($catrow=$cstmt->fetch(PDO::FETCH_ASSOC))
                    {
                     
                ?>
            <li class=""><a aria-expanded="false" data-toggle="tab" href="#cat<?=$catrow['category_id']?>"><?=$catrow['category_name']?></a></li>
                <?php
                }
                ?>
        </ul><br>
    <div id="gallerynew"></div>
    <div class="tab-content">
        <div id="all" class="tab-pane fade active in">
            <div class="col-md-12" id="allthings">
                <?php
                    $stmt = $pdo->query("SELECT * FROM items");
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $tstmt=$pdo->query("SELECT category_name from category where category_id=".$row['category_id']);
                        $cat=$tstmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <a class="itemclick" id="item<?=$row['item_id']?>" data-toggle="modal" data-target="#itembuy<?=$row['item_id']?>">
                    <div class="prodbox"> 
                        <div class="pro_h"><?=$row['item_name']?><br><span style="font-size:80%;"><?=$cat['category_name']?></span></div>	
                        <div class="pro_im "  style="background-image:url('img/<?=$row['item_name'].".jpg"?>');"></div> 
                        <div class="pro_more"><span style="border:0.2em outset red; background-color:red;">₹<?=$row['price']?></span><br>Buy Now</div>
                    </div>
                </a>
                <?php
                    }
                ?>
            </div>
        </div>
        <?php
            $cstmt= $pdo->query("SELECT * FROM category");
            while($catrow=$cstmt->fetch(PDO::FETCH_ASSOC))
            {
        ?>
        <div id="cat<?=$catrow['category_id']?>" class="tab-pane fade">
            <div class="col-md-12" id="catid<?=$catrow['category_id']?>">
                <?php
                    $stmt = $pdo->query("SELECT * FROM items WHERE category_id=".$catrow['category_id']);
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                ?>
                <a class="itemclick" id="item<?=$row['item_id']?>" data-toggle="modal" data-target="#itembuy<?=$row['item_id']?>">
                    <div class="prodbox">
                        <div class="pro_h"><?=$row['item_name']?><br><span style="font-size:80%;"><?=$catrow['category_name']?></span></div>	
                        <div class="pro_im" style="background-image:url('img/<?=$row['item_name'].".jpg"?>');"></div> 
                        <div class="pro_more"><span style="border:0.2em outset red; background-color:red;">₹<?=$row['price']?></span><br>Buy Now</div>
                    </div>
                </a>
                <?php
                    }
                ?>
            </div>
        </div>
        <?php
            }
        ?>		
    </div>	
    <div class="col-md-10 col-md-offset-1 galler">
        <?php
        $mstmt = $pdo->query("SELECT * FROM items");
        while($rowmod = $mstmt->fetch(PDO::FETCH_ASSOC))
        {
            $tstmt=$pdo->query("SELECT category_name from category where category_id=".$rowmod['category_id']);
            $cat=$tstmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <div id="itembuy<?=$rowmod['item_id']?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

            <div class="modal-content product_s">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 id="productname" class="modal-title"><?=$rowmod['item_name']?></h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-4 imagepr" style="background-image:url('img/<?=$rowmod['item_name']?>.jpg'); ">

                    </div>
                <div class="col-md-8 prod_det_o">
                    <div class="prod_heading" id="p_h"><?=$rowmod['item_name']?></div>
                    <div class="prod_cat" id="p_cat"><?=$cat['category_name']?></div>
                    <div class="prod_pr" id="p_price">₹<?=$rowmod['price']?> per piece</div>
                    <div class="form_quant">
                        <label class="enter_quant">Please enter quantity</label>
                        <input name="quant" class="num_q" type="number"> 
                    </div>
                    <a class="close_skip" data-dismiss="modal">Skip</a>
                    <a class="close_skip">Add To Cart</a>
                </div>
                </div>

            </div>

        </div>
    </div>
    <?php
    }
    ?>
</section>
</body>
</html>