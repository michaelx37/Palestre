<!-- 1 -->      <!-- 1 -->

<div class="header">        
    <div class="left-header">
        <a href="index.php">
            <div class="logo">
                LOGO/HOME
            </div>
        </a>
    </div>            
    <div class="right-header">
        <div class="account">
            <button id='loginBtn' style=" <?php if(isset($_SESSION["userNickname"])){echo "display:none";}else{echo "display:inline";}?> ">Accedi</button>
            <span style=" <?php if(isset($_SESSION["userNickname"])){echo "display:inline";}else{echo "display:none";}?> "><?php echo $welcome.$_SESSION["userNickname"]; ?></span>
            <a href='gymlogout.php' style=" <?php if(isset($_SESSION["userNickname"])){echo "display:inline";}else{echo "display:none";}?> "><button type='button'>Esci</button></a>
            <button id='regBtn' style=" <?php if(isset($_SESSION["userNickname"])){echo "display:none";}else{echo "display:inline";}?> ">Registrati</button>
        </div>
        <div class="menu">
            =
        </div>
    </div>
</div> <!-- .header --> 


<!-- 2 -->      <!-- 2 -->

<div id="headerAlt">
    <div class="leftHeaderAlt">
        <span class="headerBtn">LOGO / HOME</span>
    </div>            
    <div class="rightHeaderAlt">
        <div class="accountAlt">
            <span class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:none";}else{echo "display:block";}?> ">Accedi</span>
            <span class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:none";}else{echo "display:block";}?> ">Registrati</span>
            <span class="userAvatar" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block;background-image:url(".$loggedUserAvatar.");";}else{echo "display:none";}?> "></span>
            <span class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> "><?php echo $welcome.$_SESSION["userNickname"]; ?></span>
            <span class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> ">Esci</span>
        </div>
    </div>
</div><!-- #headerAlt -->


<!-- 3 -->      <!-- 3 -->

<div id="headerAlt">
    <div class="leftHeaderAlt">
        <a href="index.php" class="headerBtn">LOGO / HOME / INDEX</a>
    </div>            
    <div class="rightHeaderAlt">
        <div class="accountAlt">
            <span id="loginBtn" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:none";}else{echo "display:block";}?> ">Accedi</span>
            <span id="regBtn" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:none";}else{echo "display:block";}?> ">Registrati</span>
            <span class="userAvatar" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block;background-image:url(".$loggedUserAvatar.");";}else{echo "display:none";}?> "></span>
            <a href="session.php" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> "><?php echo $welcome.$_SESSION["userNickname"]; ?></a>
            <a href="gymlogout.php" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> ">Esci</a>
        </div>
    </div>
</div><!-- #headerAlt -->