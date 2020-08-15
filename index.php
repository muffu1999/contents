<?php ob_start(); ?>
  <?php session_start(); ?>
   <?php include "includes/header.php"; ?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
               <h1 class="page-header">
                    Posts
                  
                </h1>

               <?php
                $query_count="select * from posts where post_status='published'";
                $results=mysqli_query($con,$query_count);
                $count=mysqli_num_rows($results);
                if($count<1)
                { echo " <marquee scrollamount=12>No Posts Available</marquee>"; }
                $count=ceil($count/2);
                 if(isset($_GET['p']))
                {
                    $page=$_GET['p'];
                 }
                else
                {    $page="";}
                
                
                    if($page==""||$page==1)
                    {
                        $page1=0;
                    }
                    else
                    {
                        $page1=($page*2)-2;
                    }
                
                  $query="select * from posts where post_status='published' limit $page1 ,2";
                  $result=mysqli_query($con,$query);
                while($row=mysqli_fetch_assoc($result))
                {   $id=$row['post_id'];
                    $title=$row['post_title'];
                    $author=$row['post_user'];
                    $dates=$row['post_date'];
                    $image=$row['post_image'];
                    $content=substr($row['post_content'],0,100);
                    $status=$row['post_status'];
                 ?>   
                  
               
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $id?>"><?php echo $title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author.php?name=<?php echo $author ?>"><?php echo $author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $dates ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $id?>">
                <img class="img-responsive" src="images/<?php echo $image; ?>" alt="image">
                </a>
                <hr>
                <p><?php echo $content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span>
                </a>

                <hr>  
               <?php }?>
                <!-- Pager -->
                

            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
            
        </div>
        <!-- /.row -->

        <hr>
        <ul class="pager">
        <?php 
            for($i=1;$i<=$count;$i++)
            {
            echo "<li><a href='index.php?p=$i'>$i</a></li>";      
            }
        ?>
        </ul>
        
        
        
       

        <?php include "includes/footer.php"; ?>