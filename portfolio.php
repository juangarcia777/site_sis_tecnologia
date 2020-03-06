<?php require 'includes/head.php'; ?>
<?php require 'includes/menu.php'; ?>



    <div class="banner-section">
        <div class="container">
            <div class="page-title">
                <div class="page-title-inner">
                    <div class="breadcrumbs text-left">
                        <div class="breadcrumbs-wrap">
                            <h1 class="title">Portfólio</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- banner-section -->
    <div class="flat-row flat-portfolio flat-portfolio-type1">
        <div class="container">
            <div class="row">

                <?php
                    $hoje=date("Y-m-d");
                    $db = new DB();    
                    $sel = $db->select("SELECT * FROM trabalhos ORDER BY id DESC");
                    
                    if($db->rows($sel)){
                        $x=0;
                        $y=0;
                        while($yy = $db->expand($sel)) {
                        if ($x==2) {
                        if ($y<=3) {
                        ?>

                        <div class="col-lg-4 col-12">
                            <div class="gallery-item">
                                <div class="image-box">
                                    <a href=""><img src="admin/img/<?php echo $yy['urli']; ?>" alt="images"></a>
                                    <div class="hover-effect">
                                        <div class="text-inside">
                                            <h3 class="name"><a href="<?php echo $yy['link'] ?>"><?php echo $yy['descricao'] ?></a></h3>
                                            <div class="title"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php $y++; ($y==3)?$x=0:''; }  } else { ?>
                        
                            <div class="col-lg-6 col-12">
                            <div class="gallery-item">
                                <div class="image-box">
                                    <a href="<?php echo $yy['link'] ?>"><img src="admin/img/<?php echo $yy['urli']; ?>" alt="images"></a>
                                    <div class="hover-effect">
                                        <div class="text-inside">
                                            <h3 class="name"><a href="<?php echo $yy['link'] ?>"><?php echo $yy['descricao'] ?></a></h3>
                                            <div class="title"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <?php $x++; }}} ?>

            </div>
           
        </div>
    </div><!-- portfolio -->
   
<?php require 'includes/footer.php'; ?>
