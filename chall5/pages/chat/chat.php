<?php

    include_once "../../db.php";
    if(!isset($_SESSION['usr']))
        header("Location: /index.php");

    $recv = intval($_GET['user']);
    $send = $_SESSION['pid'];
    $mid = 0;
    if(isset($_GET['mid'])) $mid = $_GET['mid'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="chat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <section class="msger">
    <header class="msger-header">
        <div class="msger-header-title">
            <a href="../tables/basic-table.php" style="color:black"><i class="fa fa-arrow-left"></i></a>
            <i class="fas fa-comment-alt"></i>Chatbox
        </div>
        <div class="msger-header-options">
        <span><i class="fas fa-cog"></i></span>
        </div>
    </header>

    <main class="msger-chat">
        <?php
            $ka = $conn->prepare("SELECT * FROM message WHERE (sid=$recv OR sid=$send)");
            $ka->execute();
            while ($rt = $ka->fetch()) {
                if($rt['sid']==$recv && $rt['rid']==$send){
                    echo '<div class="msg left-msg">';
                    echo '<div class="msg-img" style="background-image: url(../../photo/'.$rt['sava'].')"></div>';
                    echo '<div class="msg-bubble">';
                    echo '<div class="msg-info">';
                    echo '<div class="msg-info-name">'.$rt['send'].'</div>';
                    echo '</div>';
                    echo '<div class="msg-text">'.$rt['mess'].'</div>';
                    echo '</div></div>';
                }
                if($rt['sid']==$send && $rt['rid']==$recv){
                    if($mid==$rt['mid']){
                        echo '<div class="msg right-msg">';
                        echo '<div class="msg-img" style="background-image: url(../../photo/'.$rt['sava'].')"></div>';
                        echo '<div class="msg-info">';
                        echo '<div class="msg-info-time"><a href="delete.php?user='.$recv.'&mid='.$rt['mid'].'">Dalete </a></div>';
                        echo '<form class="msger-inputarea" method="POST" action="editmess.php?mid='.$mid.'&user='.$recv.'">
                            <input type="text" class="msger-input" placeholder="Enter your message..." name="mess" value="'.$rt['mess'].'" required>
                            <button class="msger-send-btn">Change</button>
                        </form></div></div>';
                    }
                    else{
                        echo '<div class="msg right-msg">';
                        echo '<div class="msg-img" style="background-image: url(../../photo/'.$rt['sava'].')"></div>';
                        echo '<div class="msg-bubble">';
                        echo '<div class="msg-info">';
                        echo '<div class="msg-info-name">'.$rt['send'].'</div>';
                        echo '<div class="msg-info-time"><a href="chat.php?user='.$recv.'&mid='.$rt['mid'].'">Edit</a></div>';
                        echo '</div>';
                        echo '<div class="msg-text">'.$rt['mess'].'</div>';
                        echo '</div></div>';
                    }
                }
            } 
        ?>
    </main>
    <form class="msger-inputarea" method="POST" action="sendmess.php?user=<?php echo $recv; ?>">
        <input type="text" class="msger-input" placeholder="Enter your message..." name="mess" required>
        <button class="msger-send-btn">Send</button>
    </form>
    </section>
    
</body>

</html>

